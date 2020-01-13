<?php 
session_start();

class Auth extends Controller {

    public function authentication($username,$password){
        if(!empty($username) && !empty($password)){
            if($this->getAuthentication($username,$password)){
                $_SESSION['username'] = $username;
                return true;
            }else{
                session_destroy();
                session_start();
                return false;
            }
        }
    }

    public function checkLoginStatus(){
        if(isset($_SESSION['username'])){
            return true;
        }else{
            return false;
        }
    }

    public function logout(){
        session_destroy();
        session_start();
    }

}