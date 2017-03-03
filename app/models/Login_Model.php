<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

/**
 * @author ARTANIS
 *
 */
class Login_Model extends CI_Model{
    private $user;
    private $password;
    function __construct() {
        parent::__construct ();
    }
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
  
    public function login(){
       $userData =  R::findOne('ListadoUsuarios', "usuario = ? and password = ? ",array($this->user,$this->password));
       if (count($userData)>0){
           return $userData;
       }
       return FALSE;
    }
   
}