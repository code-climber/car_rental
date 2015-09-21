<?php

namespace car_rental\model;

/**
 * Description of Car
 *
 * @author Samy
 */
class Car {
    private $id;
    private $sBrand;
    private $sModel;
    private $sColor;
    private $sDescription;
    private $sImage;
    private $fPrice;
    private $sCategory;
    private $sTags = array();
    
    function getId() {
        return $this->id;
    }

    function getBrand() {
        return $this->sBrand;
    }

    function getModel() {
        return $this->sModel;
    }

    function getColor() {
        return $this->sColor;
    }

    function getDescription() {
        return $this->sDescription;
    }

    function getImage() {
        return $this->sImage;
    }

    function getPrice() {
        return $this->fPrice;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setBrand($sBrand) {
        $this->sBrand = $sBrand;
    }

    function setModel($sModel) {
        $this->sModel = $sModel;
    }

    function setColor($sColor) {
        $this->sColor = $sColor;
    }

    function setDescription($sDescription) {
        $this->sDescription = $sDescription;
    }

    function setImage($sImage) {
        $this->sImage = $sImage;
    }

    function setPrice($fPrice) {
        $this->fPrice = $fPrice;
    }

    function getCategory() {
        return $this->sCategory;
    }

    function setCategory($sCategory) {
        $this->sCategory = $sCategory;
    }

    function getTags() {
        return $this->sTags;
    }

    function setTags($sTags) {
        $this->sTags = $sTags;
    }


    
}
