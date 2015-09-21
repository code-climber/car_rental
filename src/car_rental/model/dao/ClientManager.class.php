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

        if($sResult != false && $sResult['passwd'] == sha1($sResult['salt']).sha1($oClient->getPasswd())){
            $_SESSION['role'] = $sResult['role'];
        }else{
            die("zaz");
            unset($_SESSION['role']);
            return false;
        }
        return true;
    }
}
