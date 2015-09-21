<?php

namespace car_rental\model;

/**
 * Description of Client
 *
 * @author Samy
 */
class Client {
    
    private $id;
    private $sFirstName;
    private $sLastName;
    private $sEmail;
    private $iPhone;
    private $sAddress;
    private $iZipCode;
    private $sCity;
    private $sState;
    private $dDateOfBirth;
    private $iRole;
    private $sLogin;
    private $sPasswd;
    private $sSalt;
    
    function getId() {
        return $this->id;
    }

    function getFirstName() {
        return $this->sFirstName;
    }

    function getLastName() {
        return $this->sLastName;
    }

    function getEmail() {
        return $this->sEmail;
    }

    function getPhone() {
        return $this->iPhone;
    }

    function getAddress() {
        return $this->sAddress;
    }

    function getZipCode() {
        return $this->iZipCode;
    }

    function getCity() {
        return $this->sCity;
    }

    function getState() {
        return $this->sState;
    }

    function getDateOfBirth() {
        return $this->dDateOfBirth;
    }

    function getRole() {
        return $this->iRole;
    }

    function getPasswd() {
        return $this->sPasswd;
    }

    function getSalt() {
        return $this->sSalt;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setFirstName($sFirstName) {
        $this->sFirstName = $sFirstName;
    }

    function setLastName($sLastName) {
        $this->sLastName = $sLastName;
    }

    function setEmail($sEmail) {
        $this->sEmail = $sEmail;
    }

    function setPhone($iPhone) {
        $this->iPhone = $iPhone;
    }

    function setAddress($sAddress) {
        $this->sAddress = $sAddress;
    }

    function setZipCode($iZipCode) {
        $this->iZipCode = $iZipCode;
    }

    function setCity($sCity) {
        $this->sCity = $sCity;
    }

    function setState($sState) {
        $this->sState = $sState;
    }

    function setDateOfBirth($dDateOfBirth) {
        $this->dDateOfBirth = $dDateOfBirth;
    }

    function setRole($iRole) {
        $this->iRole = $iRole;
    }

    function setPasswd($sPasswd) {
        $this->sPasswd = $sPasswd;
    }

    function setSalt($sSalt) {
        $this->sSalt = $sSalt;
    }
    
    function getLogin() {
        return $this->sLogin;
    }

    function setLogin($sLogin) {
        $this->sLogin = $sLogin;
    }


    
}
