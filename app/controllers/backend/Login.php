<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{

    protected $data = array();

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Perfil_Model', 'perfil');
        $this->load->model('Usuarios_Model', 'usuarios');
        $this->load->model('Login_Model', 'login');
        $this->load->library('Ajax_pagination', 'paginacion');
        $this->data['uri'] = $this->uri->segment_array();
        add_js(array(
            BASE_JS_BO . 'login.js'
        )
        );
    }

    public function index()
    {
        $this->data['titulo_pagina'] = "Inicio Sesion";
        $this->data['subtitulo_pagina'] = "ingrese usuario y contrase&ntildea para ingresar";
        $this->data['titulo'] = "Inicio de Sesion";
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('backend/login/login', $this->data);
    }

    public function login()
    {
        $this->login->setUser($this->input->post('user'));
        $this->login->setPassword($this->enc->encode($this->input->post('password')));
        if ($user = $this->login->login()) {
            $this->session->set_userdata(array(
                "id" => $user->id,
                "username" => $user->usuario,
                "useremail" => $user->email,
                "userprofile" => $user->descripcion,
                "user" => $user->nombre,
                "userlogued" => true
            ));
            
            print_r($this->session->userdata);
            
            setFlash('loguedIn', 'Bienvenido' . $user->name);
            //redirect(BASE_BO . 'dashboard', "refresh");
        }else{
            echo "login error";
        }
    }
}