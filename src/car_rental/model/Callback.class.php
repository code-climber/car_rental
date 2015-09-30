<?php

namespace car_rental\model;

use car_rental\model\dao\DBOperation;

/**
 * Description of Callback
 *
 * @author Samy
 */
class Callback {

    public function validPasswd($sPasswd) {

        $r1 = '/#[A-Z]+#/';  //at least one uppercase
        $r2 = '/#[a-z]+#/';  //at least one lowercase
        $r3 = '/#[!@#$%^&*()\-_=+{};:,<.>]+#/';  // at least one special char
        $r4 = '/#[0-9]+#/';  //at least one number

        if (preg_match($r1, $sPasswd)) {
            return false;
        }
        if (preg_match_all($r2, $sPasswd)) {
            return false;
        }
        if (preg_match_all($r3, $sPasswd)) {
            return false;
        }
        if (preg_match_all($r4, $sPasswd)) {
            return false;
        }
        if (strlen($sPasswd) < 8) {
            return false;
        }
        return $sPasswd;
    }

    public static function validLogin($sLogin) {
        $sQuery = 'SELECT login FROM clients WHERE login = :login';
        $aQueyParams = array(':login' => $sLogin);
        
        $bIsLoginExist = DBOperation::getOne($sQuery,$aQueyParams);

        if ($bIsLoginExist == true) {
            return false;
        }
        return true;
    }

//    public static function sanitizeDate($dateString) {
//        $dateString = str_replace('/', '-', $dateString);
//        $dateString = date('d-m-Y', strtotime($dateString));
//        
//        $date = new \DateTime($dateString);
//        return $date->format('d/m/Y');
//    }
    public static function sanitizeDate($dateString){
        return $dateTime = new \DateTime($dateString);
    }
    

}
