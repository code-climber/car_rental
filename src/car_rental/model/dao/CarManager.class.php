<?php

namespace car_rental\model\dao;

use car_rental\model\dao\DBOperation;
use car_rental\model\Car;
use car_rental\model\Location;
use car_rental\model\Category;


/**
 * Description of CarUserManager
 *
 * @author Samy
 */
class CarManager {

    private static function convertToObject($aCar) {
        $oCar = new Car();
        $oCar->setId($aCar['id']);
        $oCar->setBrand($aCar['brand']);
        $oCar->setModel($aCar['model']);
        $oCar->setColor($aCar['color']);
        $oCar->setDescription($aCar['description']);
        $oCar->setImage($aCar['image']);
        $oCar->setCategory($aCar['category']);
        $oCar->setPrice($aCar['price_day']);
        if (!empty($aCar['tags'])) {
            $oCar->setTags($aCar['tags']);
        }
        return $oCar;
    }

    public static function getAllCars() {
        $sQuery = 'SELECT c.id,c.brand,c.model,c.color,SUBSTR(c.description,1,200) as description,c.image,p.price_day,cat.category FROM cars AS c ';
        $sQuery .= 'JOIN prices AS p ON c.price_id = p.id_price ';
        $sQuery .= 'JOIN categories AS cat ON cat.id_category = c.category_id ';
        $sQuery .= 'ORDER BY p.price_day ';

        $aCars = array();
        
        $param = '';
        foreach (DBOperation::getAll($sQuery,$param) as $aCar) {
            $idCar = $aCar['id'];
            $sQueryTags = 'SELECT t.tag,c.id FROM `describe` AS d JOIN tags AS t ON t.id=d.tag_id ';
            $sQueryTags .= 'JOIN cars AS c ON c.id=d.car_id WHERE c.id= :idCar';
            $sQueryTags .= ' ORDER BY c.id ;';

            $aTags = array();
            foreach (DBOperation::getAll($sQueryTags, $idCar) as $aTag) {
                $aTags[] = $aTag;
            }
            $aCar['tags'] = $aTags;
            $aCars[] = self::convertToObject($aCar);
        }
        return $aCars;
    }

    public static function getOneCar($idCar) {
//        requête de récupération des voitures, des prix et catégories
        $sQuery = 'SELECT c.id,c.brand,c.model,c.color,c.description,c.image,p.price_day,cat.category FROM cars AS c ';
        $sQuery .= 'JOIN prices AS p ON c.price_id = p.id_price ';
        $sQuery .= 'JOIN categories AS cat ON cat.id_category = c.category_id ';
        $sQuery .= 'WHERE c.id = :idCar';
        
//        requête de récupération des tags
        $sTagQuery = 'SELECT t.tag,c.id FROM `describe` AS d JOIN tags AS t ON t.id=d.tag_id ';
        $sTagQuery .= 'JOIN cars AS c ON c.id=d.car_id WHERE c.id= :idCar';

        //remplissage d'un tableau de voitures sans les tags

        $aCar = array();
        $aCar = DBOperation::getOne($sQuery,$idCar);

        //remplissage d'un tableau de tags
        $aTags = array();
        foreach (DBOperation::getAll($sTagQuery,$idCar) as $aTag) {
            $aTags[] = $aTag;
        }

        //ajout du tableau de tags au tableau de voitures
        $aCar['tags'] = $aTags;

        $oCar = null;
        if (false !== $aCar) {
            $oCar = self::convertToObject($aCar);
        }
//        var_dump($oCar);die();
        return $oCar;
    }

    public static function getAllBrands() {
        $sQuery = 'SELECT brand FROM cars GROUP BY brand;';
        $aBrands = array();
        $aBrands = DBOperation::getAll($sQuery);
        return $aBrands;
    }
    
    public static function getAllCarsByLocation(Location $oLocation, Category $oCategory){
        //get values from object
        $sPickupLoc = $oLocation->getPickupLoc();
        $sCategory = $oCategory->getId();
        
        //query to get cars values and prices matching category, pick-up location and availability.
        $sQuery = 'SELECT c.id, c.brand, c.model, c.color,c.description, c.image, p.price_day, cat.category  FROM cars AS c ';
        $sQuery .= 'JOIN prices AS p ON c.price_id = p.id_price ';
        $sQuery .= 'JOIN categories AS cat ON c.category_id = cat.id_category ';
        $sQuery .= 'JOIN locate AS l ON c.id = l.car_id ';
        $sQuery .= 'WHERE l.location_id = '.$sPickupLoc.' AND c.category_id = '.$sCategory.' AND c.is_rent = 0';
        
        //getting results
        $aAvailableCars = array();
        
        foreach (DBOperation::getAll($sQuery) as $aCar) {
            $sQueryTags = 'SELECT t.tag,c.id FROM `describe` AS d JOIN tags AS t ON t.id=d.tag_id ';
            $sQueryTags .= 'JOIN cars AS c ON c.id=d.car_id WHERE c.id=' . $aCar['id'];
            $sQueryTags .= ' ORDER BY c.id ;';

            $aTags = array();
            foreach (DBOperation::getAll($sQueryTags) as $aTag) {
                $aTags[] = $aTag;
            }
            $aCar['tags'] = $aTags;
            $aAvailableCars[] = self::convertToObject($aCar);
        }
       
        return $aAvailableCars; 
    }

}
