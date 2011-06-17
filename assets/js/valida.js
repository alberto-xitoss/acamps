
/*
 * Função para validação de formulário
 *
 *
 */

var regras = [
    {
        classe: 'somenteLetras',
        regex: /^[a-zA-ZáéíóúÁÉÍÓÚâêîôûÂÊÎÔÛãõÃÕçÇªº .,;:\/\\\-]+$/i,
        msg: 'Somente letras!'
    },
    {
        classe: 'somenteNumeros',
        regex: /^\d+$/i,
        msg: 'Somente números!'
    },
    {
        classe: 'somenteAlfanumerico',
        regex: /^[a-zA-ZáéíóúÁÉÍÓÚâêîôûÂÊÎÔÛãõÃÕçÇ0-9ªº .,;:\/\\\-]+$/i,
        msg: 'Somente caracteres alfanuméricos!'
    },
    {
        classe: 'data',
        regex: /^(0?[1-9]|[1-2][0-9]|3[0-1])\/(0?[1-9]|1[0-2])\/((?:19|20)?\d{2})$/i,
        msg: 'Data inválida!'
    },
    {
        classe: 'telefone',
        regex: /^(\(?\d{2}\)?\s?)?\d{4}(-|\s)?\d{4}$/i,
        /* Formatos de telefone
         * 85 87866662
         * 8587866662
         * (85)87866662
         * (85) 87866662
         * 87866662
         * 85 8786-6662
         * 858786-6662
         * (85)8786-6662
         * (85) 8786-6662
         * 8786-6662
         */
        msg: 'Telefone inválido!'
    },
    {
        classe: 'email',
        regex: /^(?:[a-z\d\.\-_]+)@(?:[\da-z\.z\-_]+)\.(?:[a-z\.]{2,6})$/i,
        msg: 'E-mail inválido!'
    },
    {
        classe: 'cep',
        regex: /^\d{5}-?\d{3}$/i,
        msg: 'CEP inválido!'
    }
];

var radioGroups = [];

function ativarValidacao($form) {

    var allRadios = $('input[type=radio]', $form);
    while (allRadios.size() > 0) {
        var name = allRadios.get(0).name;
        radioGroups.push(name);
        allRadios = allRadios.not(document.getElementsByName(name));
    }

    // Validação Inline
    for (i in regras) {
        $inputs = $('input[type=text].'+regras[i].classe, $form);
        $inputs.bind('change',{regex:regras[i].regex, msg:regras[i].msg},function(event){
            validaTexto(this, event.data.regex, event.data.msg);
        });
    }
    $('input[type=file]', $form).change(function(){
        validaFile(this);
    });
    $('select', $form).change(function(){
        validaSelect(this);
    });
    $('input[type=radio]', $form).click(function(){
        validaRadio($('input[name='+this.name+']'));
    });
    
    // Validação OnSubmit
    $form.submit(function(event){

        var OK = true;
        //Somente após tentar submeter o Form a primeira vez, é que os campos passam a mostrar as mensagens: Campo Obrigatório!
        $('.obrigatorio').data('obrigatorio', true);
        $textInputs = $('input[type=text]'/* 'password' || 'textarea' */, $form);
        $radios = $('input[type=radio]', $form);
        $selects = $('select', $form);
        $files = $('input[type=file]', $form);
        
        for(var i in regras){
            $inputs = $('input[type=text].'+regras[i].classe, $form);
            $inputs.each(function(){
                OK &= validaTexto(this, regras[i].regex, regras[i].msg);
            });
        }
        
        if($files.size() > 0){
            $files.each(function(){
                OK &= validaFile(this);
            })
        }
        
        for(i in radioGroups){
            OK &= validaRadio($radios.filter('[name='+radioGroups[i]+']'));
        }
        
        if($selects.size() > 0){
            $selects.each(function(){
                OK &= validaSelect(this);
            });
        }
        
        if(!OK){
            //Seleciona o primeiro campo com erro
            $('.erro:first', this).focus();
            return false;
        }
    });
    
}
function validaTexto(input, regex, msg){
    if($(input).val() == ''){
        //escondeErro(input);
        if($(input).data('obrigatorio')){
            mostraErro(input, 'Campo obrigatório!');
            return false;
        }else{
            escondeErro(input);
            return true;
        }
    }else{
        //escondeErro(input);
        if(!regex.test( $(input).val() )){
            mostraErro(input, msg);
            return false;
        }else{
            escondeErro(input);
            return true;
        }
    }
}

function validaFile(input){
    if($(input).val() == ''){
        if($(input).data('obrigatorio')){
            mostraErro(input, 'Campo obrigatório!');
            return false;
        }else{
            escondeErro(input);
            return true;
        }
    }else{
        escondeErro(input);
        return true;
    }
}

function validaRadio(radio){
    var length = radio.size();
    if(length == 0 || length != radio.filter('.obrigatorio').size()) // Se o campo não for obrigatório não é necessário testar
        return true;

    var check = false;
    for(var i=0; i<length; i++){
        check |= (radio.eq(i).attr('checked') === "checked");
    }
    
    if(!check){
        mostraErro(radio[0], 'Campo obrigatório!');
        return false;
    }else{
        escondeErro(radio[0]);
        return true;
    }
}

/*
 * Retorna FALSE sempre que o valor ZERO estiver selecionado
 */
function validaSelect(select){
    if($(select).val() == '0'){
        mostraErro(select, 'Campo obrigatório!');
        return false;
    }else{
        escondeErro(select);
        return true;
    }

}

function mostraErro(input, msg){
    if(!$(input).hasClass('erro')){
        $(input).addClass('erro');
        $('<span>',{
            'class': "erro_inline",
            text: msg,
            click: function(){
                escondeErro($(this).prev());
            }
        }).hide().insertAfter($(input)).fadeIn(200);
    }else{
        $(input).next().text(msg);
    }
}

function escondeErro(input){
    if($(input).hasClass('erro')){
        $(input).removeClass('erro');
        $(input).next().fadeOut(200).remove();
    }
}
