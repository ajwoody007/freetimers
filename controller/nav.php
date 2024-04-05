<?php

include_once('GardenClass.php');
$objGardenClass = new GardenClass();

if(isset($_POST['calc_garden'])) {$objGardenClass->calculateBags(); } 
if(isset($_POST['reset_calc_garden'])) { 
    unset($_SESSION['actual_bags']); 
    unset($_SESSION['area_unit']);
    unset($_SESSION['depth_unit']);
    header('location: ../view/index.php'); 

}

