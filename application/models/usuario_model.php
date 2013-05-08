<?php

class Usuario_model extends CI_Model {
    
    var $table = 'usuario';

    function autenticar($login, $senha) {
        //log_message('error',$login.' - '.$senha);
        $this->db->select('id_usuario, nm_usuario, cd_permissao')->from($this->table)->where('nm_usuario',$login)->where("pw_usuario = md5('".$senha."')");
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row();
        }else{
            return false;
        }
    }
    
    function atualizar($id_usuario, $campos){
        foreach($campos as $campo => $valor){
            $this->db->set($campo, $valor);
        }
        $this->db->update($this->table);
    }
}
?>
