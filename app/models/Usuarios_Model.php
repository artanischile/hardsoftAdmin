<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author ARTANIS
 *        
 */
class Usuarios_Model extends CI_Model{
    protected $tableName='usuarios';
    protected $Pk ='usr_id';
    protected $vwListado='ListadoUsuarios';
   
    function __construct(){
       parent::__construct();
    }
    
    public function GetAll($page,$offset){
        return R::findAll( $this->vwListado , " ORDER BY id  LIMIT {$page} OFFSET {$offset}" );
    }
    
    public function GetById($id = null) {
        return  R::findOne($this->tableName, 'id = ? ', array($id));
    }
     
    public function GetAllBy($field =null,$value=null) {
        return  R::find($this->tableName, "{$field}= ? ", array($value));
    }
    
    public function GetBy($field =null,$value=null) {
        return   R::findOne($this->tableName, "{$field} = ? ", array($value));
    }
    
    public  function  RecordCount(){
        return R::count( $this->tableName );
    }
        
    public function Save($data='') {
  
        if ($data->id > 0) {
            $usuario = R::load($this->tableName,$data->id);
        } else {
            $usuario = R::dispense($this->tableName);
        }
        $usuario->nombre            =   $data->nombre;
        $usuario->email             =   $data->email;
        $usuario->usuario           =   $data->usuario;
        $usuario->password          =   $data->password;
        $usuario->perfil            =   $data->perfil;
        $usuario->estado            =   $data->estado;
        $usuario->fecha_creacion    =   $data->fecha_creacion;
        return R::store($usuario);
    }
    
    function Activar($id=NULL){
       $usuario=R::load($this->tableName, $id);
       if ($usuario->estado==1) {
           $usuario->estado=0;
       }else{
           $usuario->estado=1; 
       }
       return R::store($usuario);
    }
    
    
    public function Delete($id=null){
        $delete = R::load($this->tableName, $id);
        return R::trash($delete);
    }
    

    
    
}