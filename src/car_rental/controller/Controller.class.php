<?php

namespace car_rental\controller;

/**
 * Main controller
 *
 * @author Samy
 */
class Controller {
    
    public function __construct(){
        
        $this->exec();
    }
    protected function exec(){

        //controller par défaut
        $sGetController = 'front';
        
        //récupération du controller demandé dans l'url
        if(array_key_exists('controller', $_GET)){
            $sGetController = $_GET['controller'];
        }
        
        //méthode par défaut
        $sGetMethod = 'home';
        
        //récupération de la méthode demandée dans l'url
        if(array_key_exists('method', $_GET)){
            $sGetMethod = $_GET['method'];
        }
       
        //inclusion du header
        require ROOT . 'inc/site.header.inc.php';
        
        //récupérer le nom du controller demandé
        $sController = __NAMESPACE__."\\".strtolower($sGetController)."Controller";

        //récupérer le nom de la méthode demandée
        $sFunction = strtolower($sGetMethod)."Action";
                
        //vérifier que la class correspondante au controller demandé existe.
        //Si oui, on la charge automatiquement (autoload avec true)
        if(class_exists($sController, true)){
            
            $oController = new $sController();
            
            //On vérifie si la méthode demandée existe dans la classe controller demandée.
            //Si oui, on l'appel, sinon, on renvoie vers la page d'erreur.
            if(method_exists($oController, $sFunction)){
                
                $oController->$sFunction();
            }else{
                self::errorAction();
            }
        }else{
            self::errorAction();
        }
        
        //inclure le footer
        require ROOT . 'inc/site.footer.inc.php';
    }
    
    public static function errorAction(){
        require ROOT . 'src/car_rental/view/error.php';
    }
    
}
