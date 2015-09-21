<?php

namespace car_rental\model;


/**
 * Description of Location
 *
 * @author Samy
 */
class Location {
    private $idLocation;
    private $location;
    private $desc_location;
    private $latlon;
    
    function getIdLocation() {
        return $this->idLocation;
    }

    function getLocation() {
        return $this->location;
    }

    function getDesc_location() {
        return $this->desc_location;
    }

    function getLatlon() {
        return $this->latlon;
    }

    function setIdLocation($idLocation) {
        $this->idLocation = $idLocation;
    }

    function setLocation($location) {
        $this->location = $location;
    }

    function setDesc_location($desc_location) {
        $this->desc_location = $desc_location;
    }

    function setLatlon($latlon) {
        $this->latlon = $latlon;
    }


    
}
