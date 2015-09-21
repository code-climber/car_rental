<?php

namespace car_rental\model;

/**
 * Description of Category
 *
 * @author Samy
 */
class Category {
    private $id;
    private $sCategory;
    
    function getId() {
        return $this->id;
    }

    function getCategory() {
        return $this->sCategory;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCategory($sCategory) {
        $this->sCategory = $sCategory;
    }


}
