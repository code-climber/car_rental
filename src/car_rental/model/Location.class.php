<?php

namespace car_rental\model;


/**
 * Description of Location
 *
 * @author Samy
 */
class Location {
    private $idLocation;
    private $sLocation;
    private $sPickupLoc;
    private $sDropoffLoc;
    private $dPickup;
    private $dDropoff;
    private $desc_location;
    private $latlon;
    
    function getIdLocation() {
        return $this->idLocation;
    }

    function getLocation() {
        return $this->sLocation;
    }

    function getPickupLoc() {
        return $this->sPickupLoc;
    }

    function getDropoffLoc() {
        return $this->sDropoffLoc;
    }

    function getPickup() {
        return $this->dPickup;
    }

    function getDropoff() {
        return $this->dDropoff;
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

    function setLocation($sLocation) {
        $this->sLocation = $sLocation;
    }

    function setPickupLoc($sPickupLoc) {
        $this->sPickupLoc = $sPickupLoc;
    }

    function setDropoffLoc($sDropoffLoc) {
        $this->sDropoffLoc = $sDropoffLoc;
    }

    function setPickup($dPickup) {
        $this->dPickup = $dPickup;
    }

    function setDropoff($dDropoff) {
        $this->dDropoff = $dDropoff;
    }

    function setDesc_location($desc_location) {
        $this->desc_location = $desc_location;
    }

    function setLatlon($latlon) {
        $this->latlon = $latlon;
    }
 
}
