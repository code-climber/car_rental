<?php

namespace car_rental\model\dao;

use car_rental\model\dao\DBOperation;
use car_rental\model\Category;

/**
 * Description of CategoryManager
 *
 * @author Samy
 */
class CategoryManager {
    
    private static function convertToObject($aCategory){
        $oCategory = new Category();
        $oCategory->setId($aCategory['id_category']);
        $oCategory->setCategory($aCategory['category']);
        return $oCategory;
        
    }
    
    public static function getAllCategories(){
        $sQuery = 'SELECT * FROM categories;';
        $aQueryParams = array();
        $aCategories = array();
        
        foreach(DBOperation::getAll($sQuery,$aQueryParams) as $aCategory){
            $aCategories[] = self::convertToObject($aCategory);
        }
        return $aCategories;
    }
}
