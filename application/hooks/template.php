<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template {

    private $base_url;
    private $template_path;
    private $css_url;
    private $js_url;
    /**
    * Este metodo é chamado atraves do arquivo hooks.php
    * na pasta config.
    *
    * @return
    */
    public function init()
    {
        // Instancia do CI.
        $CI =& get_instance();
		
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')){
            echo $CI->output->get_output();
			return;
        }
		
        // Definindo os URL.
        $this->template_path = $CI->config->item('template_path');
        $this->css_url = $CI->config->item('css_url');
        //$this->js_url = $CI->config->item('js_url');

        // Pegando a saida que o CI gera normalmente.
        $output = $CI->output->get_output();
		
        // Pegando o valor de title, se definido no controller.
        $title = (isset($CI->title)) ? $CI->title : '';
		
        // Pegando o valor de description, se definido no controller.
        $description = (isset($CI->description)) ? $CI->description : '';
		
        // Links CSS definidos no controlador.
        $css = (isset($CI->css)) ? $this->createCSSLinks($CI->css) : '';

        // Links JS definidos no controlador.
        //$js = (isset($CI->js)) ? $this->createJSLinks($CI->js) : '';

        // Se layout estiver definido e a regexp nao bater.
        if (isset($CI->template) && !preg_match('/(.+).php$/', $CI->template)){
            $CI->template .= '.php';
        }
        else{
            $CI->template = 'default.php';
        }

        // Definindo caminho completo do layout.
        $template = $this->template_path . $CI->template;

        // Se o layout for diferente do default, e o arquivo nao existir.
        if ($CI->template !== 'default.php' && !file_exists($template)){
            // Exibe a mensagem, se o layout for diferente de '.php'.
            if ($CI->template != '.php') show_error("You have specified a invalid layout: " . $CI->template);
        }

        // Se o arquivo layout existir.
        if (file_exists($template)){
            // Carrega o conteudo do  arquivo.
            $template = $CI->load->file($template, true);
            // Substitui o texto {content_for_layout} pelo valor de output em layout.
            $view = str_replace('{conteudo}', $output, $template);
            // Substitui o texto {title}
            $view = str_replace('{title}', $title, $view);
            // Substitui o texto {description}
            $view = str_replace('{description}', $description, $view);
            // Links CSS.
            $view = str_replace('{css}', $css, $view);
            // Links JS.
            //$view = str_replace('{js}', $js, $view);
			
			/* // Substitui libs js locais pelas do Google CDN
			if(ENVIRONMENT == 'production'){
				$view = preg_replace('/http.*jquery\.min\.js/', "http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js", $view);
				$view = preg_replace('/http.*jquery-ui\.min\.js/', "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js", $view);
				$view = preg_replace('/http.*jquery\.ui\.datepicker.*js/', "http://jquery-ui.googlecode.com/svn/trunk/ui/i18n/jquery.ui.datepicker-pt-BR.js", $view);
			} */
        }else{
            $view = $output;
        }
		
		// Do we need to generate profile data?
		// If so, load the Profile class and run it.
		if (ENVIRONMENT == 'development' AND false)
		{
			$CI->load->library('profiler');

			// If the output data contains closing </body> and </html> tags
			// we will remove them and add them back after we insert the profile data
			if (preg_match("|</body>.*?</html>|is", $view))
			{
				$view  = preg_replace("|</body>.*?</html>|is", '', $view);
				$view .= $CI->profiler->run();
				$view .= '</body></html>';
			}
			else
			{
				$view .= $CI->profiler->run();
			}
		}

        echo $view;
    }

    /**
    * Gera os links CSS utilizados no layout.
    *
    * @return void
    */
    private function createCSSLinks($links){
        $html = "";
        for ($i = 0; $i < count($links); $i++){
            $html .= "<link rel='stylesheet' type='text/css' href='" . $this->css_url . $links[$i] . ".css' media='screen, print' />\n";
        }
        return $html;
    }

    /**
    * Gera os links JS utilizados no layout.
    *
    * @return void
    */
    /* private function createJSLinks($links){
        $html = "";
        for ($i = 0; $i < count($links); $i++){
            $html .= "<script src='" . $this->js_url . $links[$i] . ".js'></script> \n";
        }
        return $html;
    } */
}

?>