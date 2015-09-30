<?php

namespace car_rental\model\dao;
use car_rental\model\dao\DBOperation;
use car_rental\model\Client;
/**
 * Description of ClientManager
 *
 * @author Samy
 */
class ClientManager {
    
    public static function connect(Client $oClient){
        
        $sQuery = "SELECT * FROM clients WHERE login ='{$oClient->getLogin()}' limit 1";
        
        $sResult = DBOperation::getOne($sQuery);
        $hash = $sResult['passwd'];

        if($sResult != false && $sResult['passwd'] == password_verify($oClient->getPasswd(), $hash) ){
            $_SESSION['role'] = $sResult['role'];
        }else{
            unset($_SESSION['role']);
            return false;
        }
        return true;
    }
    
    public static function addClient(Client $oClient){
        //getting value from object
        $sFirstName = $oClient->getFirstName();
        $sLastName = $oClient->getLastName();
        $sEmail = $oClient->getEmail();
        $sLogin = $oClient->getLogin();

        //hash and salt the password
        $sPassword = $oClient->getPasswd();
        $sPasswordSalted = password_hash($sPassword, PASSWORD_DEFAULT);
        
        //insert into Clients table
        $sQuery = 'INSERT INTO Clients (first_name, last_name, email, login, passwd) ';
        $sQuery .= "VALUES (':firstName',':lastName',':email',':login',':saltedPasswd')";
        
        $aQueryParams = array(':firstName' => $sFirstName,':lastName' => $sLastName,':email' => $sEmail,':login' => $sLogin,':saltedPasswd'=>$sPasswordSalted);
      
        $bSuccess = DBOperation::exec($sQuery,$aQueryParams);
        
        if(!$bSuccess){
            return false;
        }
        return true;  
    }
}
