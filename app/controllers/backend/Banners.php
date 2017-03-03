<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class Usuarios extends  CI_Controller{

    protected $data = array();
     
    function __construct()
    {

        parent::__construct();
        $this->load->model('Perfil_Model','perfil');
        $this->load->model('Usuarios_Model','usuarios');
        $this->load->library('Ajax_pagination','paginacion');
        $this->data['uri']=$this->uri->segment_array();
        add_js(array(
            BASE_JS_BO.'usuarios.js'
        ));
    }
    
}    