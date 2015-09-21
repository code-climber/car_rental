<?php
class WktToJson
{
    private $_wkt;       

 
    public function __construct($le_wkt) // Constructeur demandant 2 paramètres
 {
   $this->setWkt($le_wkt); // Initialisation de la force.

 }
    
  
    public function setWkt($le_wkt){
         $this->_wkt = $le_wkt;
    }
    
    
    /*Explose le WKT selon les parenthèse => Array ( 0 => type_geom_WKT, le reste => les coordonnée*/
    private function _getExplodeWkt($wkt){
        $patern_perentheses ="#\(|\)#";
        return preg_split($patern_perentheses, $wkt);  
    }
    
    /*Défini le type de géométrie*/
   private function _getType(){
       $wkt = $this->_wkt;
        $type_geom_json ='';
        if ( preg_match('#^POINT#', $wkt) == true){ $type_geom_json = 'Point';}
        else if ( preg_match('#^POLYGON#', $wkt) == true){ $type_geom_json = 'Polygon';}
        else if ( preg_match('#^LINESTRING#', $wkt) == true){ $type_geom_json = 'LineString';}
        else if ( preg_match('#^MULTILINESTRING#', $wkt) == true){ $type_geom_json = 'MultiLineString';}
        else if ( preg_match('#^MULTIPOINT#', $wkt) == true){ $type_geom_json = 'MultiPoint';}
        else if ( preg_match('#^MULTIPOLYGON#', $wkt) == true){ $type_geom_json = 'MultiPolygon';}  
     return   $type_geom_json;
     
    }
    
    
    // c'est un mutlipolygon, on doit récupérer les polygones qui le compose
   private function _getCoordGeojsonCaseMulipolygon(){
        $wkt = $this->_wkt;
        $patern_perentheses ="#\(\(|\)\)#";
        $polygones = array();
        $multi_poly_explode = preg_split($patern_perentheses, $wkt);
        for ($i = 1; $i < count($multi_poly_explode); $i++) {
            $multi_poly_explode[$i] = trim($multi_poly_explode[$i]);
            if ($multi_poly_explode[$i] != null && $multi_poly_explode[$i] != '' && $multi_poly_explode[$i] != ',' && $multi_poly_explode[$i] != ')' && $multi_poly_explode[$i] != '('){
                array_push($polygones, "POLYGON(".$multi_poly_explode[$i]);
            }
        } 
        
        $array_coord_json_multipoly = array();
        for ($j = 0; $j < count($polygones); $j++) {
            $coord_full_json = $this->_getCoordsFullGeojson($polygones[$j],'Polygon');
            array_push($array_coord_json_multipoly, '['.$coord_full_json.']');
        }
        return join(",",$array_coord_json_multipoly);  
    }
    
    
    
    /*Get les coordonnées en String. Si le count(return) == 1, c'est une simple coordonnée, sinon c'est un truc complexe, (polygon à trou par exemple)*/
   private function _getSubGeomCoords(){
       $wkt = $this->_wkt;
        $wkt_explode = $this->_getExplodeWkt($wkt);
        $array_coord = array();
        
        for ($i = 1; $i < count($wkt_explode); $i++) {
            $wkt_explode[$i] = trim($wkt_explode[$i]);
            if ($wkt_explode[$i] != null && $wkt_explode[$i] != '' && $wkt_explode[$i] != ','){
                array_push($array_coord, $wkt_explode[$i]);
            }
        }  
        return $array_coord;
    }
    
    /*Renvoie les coordonées de la 'sub_geom' en format GEOJSON*/
    private function _getCoordSubGeomGeojson($sub_geom_coord){
        $array_couple_coord = explode(',',$sub_geom_coord);
        // print_r($array_couple_coord);
        $array_str_coords =array();
        
        for ($i = 0; $i < count($array_couple_coord); $i++) {
            $array_couple_coord[$i] = trim($array_couple_coord[$i]);
            $lng_lat =  explode(' ',$array_couple_coord[$i]);
            $lng = $lng_lat[0];
            $lat = $lng_lat[1];
            // print_r($lng_lat);
            $current_str_lng_lat_json = '['.$lng.','.$lat.']';
            array_push($array_str_coords, $current_str_lng_lat_json);
        }
        return join(",",$array_str_coords);
    }
    
    
    private function _getCoordsFullGeojson($wkt,$type_geom){
        $array_sub_geom = $this->_getSubGeomCoords();
        $array_full_geom = array();
        
        $crochet_ouvert = '';
        $crochet_ferme ='';
        if ($type_geom == 'Polygon' || $type_geom == 'MultiLineString' )
        { $crochet_ouvert = '[';$crochet_ferme =']';}
        
        for ($i = 0; $i < count($array_sub_geom); $i++) {
            $current_str_sub_geom = $this->_getCoordSubGeomGeojson($array_sub_geom[$i]);
            
            array_push($array_full_geom, $crochet_ouvert.$current_str_sub_geom.$crochet_ferme);
        }
        return  join(",",$array_full_geom);
    }
    
    public function getGeometryGeojsonFromWkt (){  
        $wkt = $this->_wkt;
       //print_r($this->_getType($wkt));
        
        $wkt = trim ($wkt);
        $type_geom = $this->_getType();
        $coord_full_json ='';
        if($type_geom == 'MultiPolygon'){
            $coord_full_json = $this->_getCoordGeojsonCaseMulipolygon();
        }
        else{
            $coord_full_json = $this->_getCoordsFullGeojson($wkt,$type_geom);
        }
        
        
        $str_geometry_geojson = '{"type":"'.$type_geom.'","coordinates":['.$coord_full_json.']}';
       // print_r($str_geometry_geojson);
        return $str_geometry_geojson;
    }
   
    
    
}


?>