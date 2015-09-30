<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>Car rental</title>
        <link type=text/css rel="stylesheet" href="css/reset.css"/>
        <link type="text/css" rel="stylesheet" href="css/main.css"/>
        <link type="text/css" rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        
        <!--Date picker -->
        <script>
            $(function(){
                $('#datepicker').datepicker({
                    minDate: 0
                });
                $('#datepicker2').datepicker({
                    minDate: 0
                });
            });
        </script>

        <!--Leaflet stuff-->
        <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
        <script src="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.js"></script>
    </head>
    <body class="<?php echo $sGetController . "-" . $sGetMethod; ?>">
        <div class="container">
            <header>
                <h2><a href="index.php?"><span>Car</span> Rental</a></h2>
                <?php require 'inc/menu.inc.php'; ?>
                <div class="clear"></div>
            </header>

