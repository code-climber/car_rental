<?php


namespace car_rental\controller;

use car_rental\controller\Controller;
use car_rental\model\dao\CarManager;
use car_rental\model\dao\LocationManager;
use car_rental\model\dao\CategoryManager;
/**
 * Description of frontController
 *
 * @author Samy
 */
class frontController {
    /*
     * HOME PAGE
     */
    public static function homeAction(){
        //hour array for select form
        $aHours = array();
        for($i=0;$i<=23;$i++){
            $aHours[] += $i;
        }
        
        //location array for select form
        $aLocations = LocationManager::getAllLocations();
        
        //category array for select form
        $aCategories = CategoryManager::getAllCategories();
        
        require ROOT . 'src/car_rental/view/home.php';
    }
    
    /*
     * TOTAL CAR LIST
     */
    public static function showCarsListAction(){
       
        $aCars = CarManager::getAllCars();
        require ROOT . 'src/car_rental/view/car_list.php';
        
    }
    
    /*
     * ONE CAR DESCRIPTION
     */
    public static function showOneCarAction(){
        if(isset($_GET['idCar'])){
            $idCar = intval($_GET['idCar']);
        }
        $oCar = CarManager::getOneCar($idCar);
        require ROOT . 'src/car_rental/view/car_desc.php';
    }
    
    /*
     * MAP OF LOCATIONS
     */
    public static function mapAction(){
        $aLocations = LocationManager::getAllLocations();
//        var_dump($aLocations);die();
        require ROOT . 'src/car_rental/view/findus.php';
    }
}
