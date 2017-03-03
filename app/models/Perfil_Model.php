
<?php
if (! defined ( 'BASEPATH' ))   exit ( 'No direct script access allowed' );
class Perfil_Model extends CI_Model {
    public   $table = 'perfil';
    function __construct() {
        parent::__construct ();
    }
    function getPerfiles() {
        $this->db->select ( '   perfil.perfil_id,
                                perfil.perfil_descripcion,
                                perfil.perfil_estado,
                                perfil.perfil_creacion,
                                perfil.perfil_admin ' )
                ->from ( 'perfil' )
                ->order_by ( "perfil.perfil_id", "desc" );
        $query = $this->db->get ();
        return $query->result ();
    }

    function getPerfilesActivos(){
        $this->db->select ( ' * ' )->from ( 'perfil' )->where('estado',1)->order_by ( "id", "desc" );
        $query = $this->db->get ();
        return $query->result ();
    }


    function getPerfilById($id) {
        if (is_numeric($id)){
            $this->db->select ( ' * ' )->from ( 'perfil' )->where('perfil_id',$id)->order_by ( "perfil_id", "desc" );
            $query = $this->db->get ();
            return $query->result ();
        }else{}

    }


    function GuardarPerfil($data) {
        if (is_array ( $data )) {
            $this->db->trans_start ();
            $this->db->insert ( $this->table, $data );
            $insert_id = $this->db->insert_id ();
            $this->db->trans_complete ();
            return true;
        } else {
            return false;
        }
    }
    function ActualizarPerfil($data = null) {
        if (is_array ( $data )) {
            $this->db->where ( 'id_perfil', $data ['id_perfil'] );
            $this->db->update ( $this->table, $data );
            return true;
        } else {
            return false;
        }
    }
}
