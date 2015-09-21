<?php

namespace car_rental\controller;

use car_rental\controller\Controller;
use car_rental\model\Client;
use car_rental\model\dao\ClientManager;
use car_rental\model\dao\CarManager;

/**
 * handle all administrator stuff
 *
 * @author Samy
 */
class backController {
    
    public function homeAction(){
        $aBrands = CarManager::getAllBrands();
//        var_dump($aBrands);die();
        require ROOT . 'src/car_rental/view/admin_home.php';
    }
    
    public function showLoginFormAction(){
        require ROOT . 'src/car_rental/view/login.php';
    }
    
    private function performConnection(){
        
        $oClient = new Client();
        $oClient->setLogin($_POST['login']);
        $oClient->setPasswd($_POST['passwd']);
        
        if(ClientManager::connect($oClient)){
            $this->homeAction();
        }else{
            $bLoginError = true;
            require ROOT . 'src/car_rental/view/login.php';
        }
    }
    
    public function loginAction(){
        if(array_key_exists('connect', $_POST)){
            $this->performConnection();
        }else{
            $bLoginError = false;
            require ROOT . 'src/car_rental/view/login.php';
        }
    }
    
    public function logoutAction(){
        unset($_SESSION['role']);
        frontController::homeAction();
    }
}
