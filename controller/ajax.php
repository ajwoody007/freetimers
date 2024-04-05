<?php session_start(); 

    include_once('GardenClass.php');
    $code_action = $_REQUEST['code_action'];

    switch ($code_action) {
        case 'apply_area_units':
            apply_area_units();
            return;
        case 'apply_depth_units':
            apply_depth_units();
            return;
        case 'add_to_basket':
            add_to_basket();
            return;
        case 'clear_basket':
            clear_basket();
            return;
        }

    function apply_area_units() {
       
        $objGarden = new GardenClass();
        $success = $objGarden->setMeasurementUnit($_REQUEST['units']);
        return ($success);

    }

    function apply_depth_units() {

        $objGarden = new GardenClass();
        $success = $objGarden->setDepthMeasurementUnit($_REQUEST['units']);
        return ($success);

    }

    function add_to_basket() {

        $objGarden = new GardenClass();
        $success = $objGarden->addToBasket();
        return ($success);

    }

    function clear_basket() {

        $objGarden = new GardenClass();
        $success = $objGarden->clearBasket();
        return ($success);

    }