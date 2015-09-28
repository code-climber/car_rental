<?php

namespace car_rental\controller;

use car_rental\model\Callback;
use car_rental\model\Location;
use car_rental\model\Category;
use car_rental\model\dao\CarManager;
use car_rental\model\dao\LocationManager;
use car_rental\model\dao\CategoryManager;

/**
 * handle all that is seen by user
 *
 * @author Samy
 */
class frontController {
    /*
     * HOME PAGE
     * display the search form to find an available car.
     */

    public static function homeAction() {
        //give an hour array for select form
        $aHours = array();
        for ($i = 0; $i <= 23; $i++) {
            $i = $i++;
            if ($i < 10) {
                $aHours[] = '0' . $i;
            } else {
                $aHours[] = $i;
            }
        }

        //give a location array for select form
        $aLocations = LocationManager::getAllLocations();

        //give a category array for select form
        $aCategories = CategoryManager::getAllCategories();

        require ROOT . 'src/car_rental/view/home.php';
    }

    /*
     * TOTAL CAR LIST
     */

    public static function showCarsListAction() {

        $aCars = CarManager::getAllCars();
        require ROOT . 'src/car_rental/view/car_list.php';
    }

    /*
     * ONE CAR DESCRIPTION
     */

    public static function showOneCarAction() {
        if (isset($_GET['idCar'])) {
            $idCar = intval($_GET['idCar']);
        }
        $oCar = CarManager::getOneCar($idCar);
        require ROOT . 'src/car_rental/view/car_desc.php';
    }

    /*
     * MAP OF LOCATIONS
     */

    public static function mapAction() {
        $aLocations = LocationManager::getAllLocations();
//        var_dump($aLocations);die();
        require ROOT . 'src/car_rental/view/findus.php';
    }

    /*
     * TREAT SEARCH CAR FORM DATA
     */

    public static function searchCarFormAction() {

        //get and check form values
        $aOptions = array(
            'pick-loc' => FILTER_SANITIZE_NUMBER_INT,
            'pick-date' => array(
                'filter' => FILTER_CALLBACK,
                'options' => [new Callback(), "sanitizeDate"]
            ),
            'pick-hour' => FILTER_SANITIZE_NUMBER_INT,
            'pick-quarter' => FILTER_SANITIZE_NUMBER_INT,
            'drop-off-loc' => FILTER_SANITIZE_NUMBER_INT,
            'drop-date' => array(
                'filter' => FILTER_CALLBACK,
                'options' => [new Callback(), "sanitizeDate"]
            ),
            'drop-hour' => FILTER_SANITIZE_NUMBER_INT,
            'drop-quarter' => FILTER_SANITIZE_NUMBER_INT,
            'category' => FILTER_SANITIZE_NUMBER_INT
        );

        $aFilteredForm = filter_input_array(INPUT_POST, $aOptions);

        /*
         * build a dateTime format for date storage in MySQL
         */
        $pickHour = $aFilteredForm['pick-hour'];
        $pickQuarter = $aFilteredForm['pick-quarter'];
        $aFilteredForm['pick-date'] = $aFilteredForm['pick-date']->setTime($pickHour, $pickQuarter);

        $dropHour = $aFilteredForm['drop-hour'];
        $dropQuarter = $aFilteredForm['drop-quarter'];
        $aFilteredForm['drop-date'] = $aFilteredForm['drop-date']->setTime($dropHour, $dropQuarter);

        //check that drop date is anterior to pick-up date.
        if ($aFilteredForm['drop-date'] < $aFilteredForm['pick-date']) {
            $aFilteredForm['drop-date'] = false;
        }
        
        //check that the pick-up date is not anterior to current time.
        $currentTime = new \DateTime();
        if($aFilteredForm['pick-date'] < $currentTime){
            $aFilteredForm['pick-date'] = false;
        }

        //counting errors
        $iError = 0;

        //creating an array of error messages
        if ($aFilteredForm != null) {
            $aErrorMessage = array(
                'pick-date' => 'Pick-up date should\'nt be anterior to current time.',
                'drop-date' => 'Drop-off date should\'nt be anterior to pick-up date. '
            );
        }
        
        $aShowErrorMsg = array();

        //Looping through options and filtered arrays and getting errors and their messages.
        foreach ($aOptions as $key => $value) {
            if (empty($_POST[$key])) {
                $aShowErrorMsg[] = "Field " . $key . " must be filled.<br>";
                $iError++;
            } elseif ($aFilteredForm[$key] === false) {
                $aShowErrorMsg[] = $aErrorMessage[$key].'<br>';
                $iError++;
            }
        }

        /*
         * if there are some errors, we give back the home page with error messages.
         * I NEED A HINT TO PROPERLY GIVE BACK HOME PAGE WITHOUT REPEATING MYSELF WITH homeAction();
         * self::homeAction() can't be used because of the need for error messages.
         */
        if ($iError > 0) {
            //hour array for select form
            $aHours = array();
            for ($i = 0; $i <= 23; $i++) {
                $i = $i++;
                if ($i < 10) {
                    $aHours[] = '0' . $i;
                } else {
                    $aHours[] = $i;
                }
            }

            //location array for select form
            $aLocations = LocationManager::getAllLocations();

            //category array for select form
            $aCategories = CategoryManager::getAllCategories();
            require ROOT . 'src/car_rental/view/home.php';
        }
        
        /*
         * if no errors, save needed informations in SESSION for later booking 
         * and hydrate objects to send them to managers for request
         */
        if ($iError == 0) {
            
            $_SESSION['pick-date'] = $aFilteredForm['pick-date'];
            $_SESSION['drop-off-loc'] = $aFilteredForm['drop-off-loc'];
            $_SESSION['drop-date'] = $aFilteredForm['drop-date'];
            
            $oLocation = new Location();
            $oLocation->setPickupLoc($aFilteredForm['pick-loc']);

            $oCategory = new Category();
            $oCategory->setId($aFilteredForm['category']);
            
            $aCars = CarManager::getAllCarsByLocation($oLocation, $oCategory);
            
            require ROOT . 'src/car_rental/view/car_list.php';
            
            var_dump($_SESSION);
        }
    }

}
