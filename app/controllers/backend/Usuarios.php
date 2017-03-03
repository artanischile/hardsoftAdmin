<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends CI_Controller
{

    protected $data = array();

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Perfil_Model', 'perfil');
        $this->load->model('Usuarios_Model', 'usuarios');
        $this->data['uri'] = $this->uri->segment_array();
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        ); 
        add_js(array(
            BASE_JS_BO . 'usuarios.js'
        ));
    }

    function index()
    {
        redirect(BASE_BO . 'usuarios/listado/', 'refresh');
    }

    function listado()
    {
        $this->load->library('pagination');
        $config['base_url'] = BASE_BO . 'usuarios/listado/';
        $config['total_rows'] = $this->usuarios->RecordCount();
        $config['per_page'] = 10; // N�mero de registros mostrados por p�ginas
        $config['num_links'] = 5;
        $config["uri_segment"] = 4; // el segmento de la paginaci�n
                                    // $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data["links"] = $this->pagination->create_links();
        $this->data['titulo_pagina'] = "Administracion Usuarios";
        $this->data['subtitulo_pagina'] = "agrega, modifica, elimina , activa o desactiva usuarios";
        $this->data['titulo'] = "Listado de Usuarios";
        $this->data['listado'] = $this->usuarios->GetAll($config['per_page'], $page);
        $this->data['content'] = 'backend/usuarios/listado';
        $this->load->view('backend/layout/layout', $this->data);
    }

    function Agregar()
    {
        $this->data['titulo_pagina'] = "Administracion Usuarios";
        $this->data['subtitulo_pagina'] = "permite agregar un nuevo usuario";
        $this->data['titulo'] = "Agregar Nuevo Usuario";
        $this->data['perfiles'] = $this->perfil->getPerfilesActivos();
        $this->data['content'] = 'backend/usuarios/agregar';
        $this->load->view('backend/layout/layout', $this->data);
    }

    function Editar($id = null)
    {
        $this->data['titulo_pagina'] = "Administracion Usuarios";
        $this->data['subtitulo_pagina'] = "permite editar un usuario existente";
        $this->data['titulo'] = "Editar  Usuario";
        $this->data['perfiles'] = $this->perfil->getPerfilesActivos();
        $this->data['usuario'] = $this->usuarios->GetById($id);
        $this->data['content'] = 'backend/usuarios/editar';
        $this->load->view('backend/layout/layout', $this->data);
    }

    function Eliminar()
    {}

    function Guardar()
    {
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean');
            $this->form_validation->set_rules('email', 'Email ', 'required|xss_clean|valid_email|is_unique[usuarios.email]');
            
            $this->form_validation->set_rules('usuario', 'Usuario', 'required|xss_clean|min_length[6]|is_unique[usuarios.usuario]');
            $this->form_validation->set_rules('password', 'Password ', 'required|xss_clean|min_length[6]');
            $this->form_validation->set_rules('perfil', 'Perfil ', 'required|xss_clean');
            
            $this->form_validation->set_rules('estado', 'Estado ', 'required|xss_clean');
            
            if ($this->form_validation->run() === FALSE) {
                $err_data = array(
                    
                    "nombre" => form_error('nombre'),
                    "email" => form_error('email'),
                    "usuario" => form_error('usuario'),
                    "password" => form_error('password'),
                    "perfil" => form_error('perfil'),
                    "estado" => form_error('estado')
                );
                $this->session->set_flashdata('errors', $err_data);
                $this->session->set_flashdata('formdata', $this->input->post());
                redirect(BASE_URL . 'bo/usuarios/Agregar');
            } else {
                // print_r($this->input->post());
                
                $this->data['id'] = $this->input->post('id_usuario', true);
                $this->data['nombre'] = $this->input->post('nombre', true);
                $this->data['usuario'] = $this->input->post('usuario', true);
                $this->data['password'] = $this->enc->encode($this->input->post('password', true));
                $this->data['email'] = $this->input->post('email', true);
                $this->data['perfil'] = $this->input->post('perfil', true);
                $this->data['estado'] = $this->input->post('estado', true);
                $this->data['fecha_creacion'] = date('Y-m-d H:i:s');
                
                if ($this->usuarios->Save((object) $this->data)) {
                    $this->session->set_flashdata('saved', 'Operacion realizada con exito');
                } else {
                    $this->session->set_flashdata('saved', 'Opps.. Error en la operacion');
                }
                
                redirect(BASE_URL . 'bo/usuarios/listado');
            }
        } else {
            
            redirect(BASE_URL . 'bo/usuarios/agergar');
        }
    }

    function Actualizar()
    {
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean');
            $this->form_validation->set_rules('email', 'Email ', 'required|xss_clean|valid_email');
            $this->form_validation->set_rules('usuario', 'Usuario', 'required|xss_clean|min_length[6]');
            $this->form_validation->set_rules('password', 'Password ', 'required|xss_clean|min_length[6]');
            $this->form_validation->set_rules('perfil', 'Perfil ', 'required|xss_clean');
            $this->form_validation->set_rules('estado', 'Estado ', 'required|xss_clean');
            
            if ($this->form_validation->run() === FALSE) {
                $err_data = array(
                    
                    "nombre" => form_error('nombre'),
                    "email" => form_error('email'),
                    "usuario" => form_error('usuario'),
                    "password" => form_error('password'),
                    "perfil" => form_error('perfil'),
                    "estado" => form_error('estado')
                );
                $this->session->set_flashdata('errors', $err_data);
                $this->session->set_flashdata('formdata', $this->input->post());
                redirect(BASE_URL . 'bo/usuarios/Agregar');
            } else {
                // print_r($this->input->post());
                
                $this->data['id'] = $this->input->post('id_usuario', true);
                $this->data['nombre'] = $this->input->post('nombre', true);
                $this->data['usuario'] = $this->input->post('usuario', true);
                $this->data['password'] = $this->enc->encode($this->input->post('password', true));
                $this->data['email'] = $this->input->post('email', true);
                $this->data['perfil'] = $this->input->post('perfil', true);
                $this->data['estado'] = $this->input->post('estado', true);
                $this->data['fecha_creacion'] = date('Y-m-d H:i:s');
                if ($this->usuarios->Save((object) $this->data)) {
                    $this->session->set_flashdata('saved', 'Operacion realizada con exito');
                } else {
                    $this->session->set_flashdata('saved', 'Opps.. Error en la operacion');
                }
                redirect(BASE_URL . 'bo/usuarios/listado');
            }
        } else {
            redirect(BASE_URL . 'bo/usuarios/agergar');
        }
    }

    public function activar()
    {  
        
        print_r($this->input->post()); 
        echo $this->input->post('reg_id');

        die();
        if ($this->usuarios->Activar($id)) {
            $this->session->set_flashdata('saved', 'Operacion realizada con exito');
        } else {
            $this->session->set_flashdata('saved', 'Opps.. Error en la operacion');
        }
        ;
        redirect(BASE_URL . 'bo/usuarios/listado', 'refresh');
    }

    function perfil($id = null)
    {
        $this->data['titulo_pagina'] = "Administracion Usuarios";
        $this->data['subtitulo_pagina'] = "agrega, modifica, elimina , activa o desactiva usuarios";
        $this->data['titulo'] = "Listado de Usuarios";
        
        $this->data['content'] = 'backend/usuarios/perfil';
        $this->load->view('backend/layout/layout', $this->data);
    }
}