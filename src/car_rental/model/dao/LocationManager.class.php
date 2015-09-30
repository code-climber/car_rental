<?php

namespace car_rental\model\dao;

use car_rental\model\Location;
use car_rental\model\dao\DBOperation;

/**
 * Description of LocationManager
 *
 * @author Samy
 */
class LocationManager {
   private static function convertToObject($aLocation){
       $oLocation = new Location(); 
       $oLocation->setIdLocation($aLocation['id_location']);
       $oLocation->setLocation($aLocation['location']);
       $oLocation->setDesc_location($aLocation['desc_location']);
       $oLocation->setLatlon($aLocation['latlon']);
       return $oLocation;
    }
    
    public static function getAllLocations(){
        $sQuery = 'SELECT * FROM locations;';
//        var_dump($sQuery);die();
        $aLocations = array();
        
        foreach(DBOperation::getAll($sQuery,'') as $aLocation){
            $aLocations[] = self::convertToObject($aLocation);
        }
        return $aLocations;
    }
}
