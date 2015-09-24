<?php

namespace car_rental\controller;

use car_rental\controller\Controller;
use car_rental\controller\frontController;
use car_rental\model\Client;
use car_rental\model\dao\ClientManager;
use car_rental\model\dao\CarManager;
use car_rental\model\Callback;

/**
 * handle all administrator stuff
 *
 * @author Samy
 */
class backController {

    public function homeAction() {
        $aBrands = CarManager::getAllBrands();
//        var_dump($aBrands);die();
        require ROOT . 'src/car_rental/view/admin_home.php';
    }

    public function showLoginFormAction() {
        require ROOT . 'src/car_rental/view/login.php';
    }

    public function showCreateAccountFormAction() {
        require ROOT . 'src/car_rental/view/create_account.php';
    }

    /*
     * TREAT THE CREATE AN ACCOUNT FORM
     * get and check form values. If ok, call a manager to insert data in clients table.
     * if not, send messages for the user to correct his form.
     */

    public function createAccountAction() {
        
        //prepare all values to be checked with a filter
        $aOptions = array(
            'first-name' => FILTER_SANITIZE_STRING,
            'last-name' => FILTER_SANITIZE_STRING,
            'login' => FILTER_SANITIZE_STRING,
            'password' => array(
                'filter' => FILTER_CALLBACK,
                'options' => [new Callback, "validPasswd"]
            ),
            'conf-password' => FILTER_SANITIZE_STRING,
            'email' => FILTER_SANITIZE_EMAIL,
            'conf-email' => FILTER_SANITIZE_EMAIL
        );
        
        $aFilteredForm = filter_input_array(INPUT_POST, $aOptions);
        
        //if login allready exist, set it false in the filtered array
        $bIsUniqueLogin = Callback::validLogin($aFilteredForm['login']);
        if($bIsUniqueLogin == false){
            $aFilteredForm['login']= false;
        }
        
        //if passwords does not match, set it false in the filtered array
        if($aFilteredForm['password'] !== $aFilteredForm['conf-password']){
            $aFilteredForm['conf-password']= false;
        }
        
        
        //error messages
        if($aFilteredForm != null){
            $aErrorMessage = array(
                'login' => 'Login exist already. Please choose another one.',
                'password'=>'Password is at least : '
                . '8 characters, one majuscule, one minuscule, one number, and one special character',
                'conf-password' => 'passwd don\'t match.',
                'email' => 'L\'adresse email n\'est pas valide',
                'conf-email' => 'email address don\'t match. '
            );
        }
        
        //count error. If error == 0, we can then send data to db.
        $iErrorNb = 0;
        
        /*
         * if fields are empty, ask to fill them.
         * else if not valid, send a precise message.
         */
       $aShowErrors = array();
        foreach($aOptions as $key=>$value){
            if(empty($_POST[$key])){
                $aShowErrors[] = 'Please fill the field '.$key.'.<br>';
                $iErrorNb++;
            }elseif($aFilteredForm[$key] === false){
                $aShowErrors[] = $aErrorMessage[$key].'<br>';
                $iErrorNb++;
            }
        }
        if($iErrorNb > 0){
            require ROOT . 'src/car_rental/view/create_account.php';
        }
        
       
        /*
         * if no error and form safe, hydrate a client object and send it to
         * client manager to add this new client in the database.
         */
        if($iErrorNb == 0){
            $oClient = new Client();
            $oClient->setFirstName($aFilteredForm['first-name']);
            $oClient->setLastName($aFilteredForm['last-name']);
            $oClient->setLogin($aFilteredForm['login']);
            $oClient->setPasswd($aFilteredForm['password']);
            $oClient->setEmail($aFilteredForm['email']);
            
            ClientManager::addClient($oClient);
            
            frontController::homeAction();
        }
        
    }

    private function performConnection() {

        $oClient = new Client();
        $oClient->setLogin($_POST['login']);
        $oClient->setPasswd($_POST['passwd']);

        if (ClientManager::connect($oClient)) {
            $this->homeAction();
        } else {
            $bLoginError = true;
            require ROOT . 'src/car_rental/view/login.php';
        }
    }

    public function loginAction() {
        if (array_key_exists('connect', $_POST)) {
            $this->performConnection();
        } else {
            $bLoginError = false;
            require ROOT . 'src/car_rental/view/login.php';
        }
    }

    public function logoutAction() {
        unset($_SESSION['role']);
        frontController::homeAction();
    }

}
