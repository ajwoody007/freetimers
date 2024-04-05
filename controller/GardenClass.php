<?php

    class GardenClass {

        public function __construct() {
            include_once("../model/GardenModel.php");
        }

        public function setMeasurementUnit($given_units) {

            if (!$given_units) { return false ; }

            $_SESSION['area_unit'] = $given_units;
            return;

        }

        public function setDepthMeasurementUnit($given_depth_unit) {

            if (!$given_depth_unit) { return false ; }

            $_SESSION['depth_unit'] = $given_depth_unit;
            return ;

        }

        public function calculateBags() {

            $area = $_POST['area'];
            $depth = $_POST['depth'];

            if (!$area || !$depth) { return false; }

            $area_unit = $_SESSION['area_unit'];
            $depth_unit = $_SESSION['depth_unit'];

            $per_bag = 1.4;

            if ($area_unit != "m") { $actual_area = $this->convertArea($area, $area_unit); } else { $actual_area = $area; }

            // 0.025 = depth; 1.4 = metres squared per bag;

            $calculated_area = $actual_area * $depth;

            $calculated_bags = $calculated_area * $per_bag;

            // add to the database before showing the new page
            
            $objModel = new GardenModel();

            $area_data = [
                'area_unit' => $area_unit,
                'depth_unit' => $depth_unit,
                'area' => $area,
                'depth' => $depth,
                'calculated_area' => $calculated_area,
                'calculated_bags' => ceil($calculated_bags)
            ];

            $success = $objModel->newCalculation($area_data);

            $_SESSION['actual_bags'] = ceil($calculated_bags);

            header('location: ../view/show_calc.php');

        }

        private function convertArea($area, $area_unit) {

            switch ($area_unit) {
                case "ft":
                    $actual_area = $area * 0.3048;
                    break;
                case "yd":
                    $actual_area = $area * 0.9144;
                    break;
                default:
                    $actual_area = $area;

            }

            return ($actual_area);

        }

        public function getPreviousValues() {

            $objModel = new GardenModel();
            $dsCalculations = $objModel->getPreviousValuesDB();
            return ($dsCalculations);

        }

        public function addToBasket() {

            $objModel = new GardenModel();
            $dsBasket = $objModel->addToBasketDB();
            return ($dsBasket);

        }

        public function getBasketTotal() {

            $objModel = new GardenModel();
            $dsTotal = $objModel->getBasketTotalDB();
            return ($dsTotal);

        }

        public function clearBasket() {

            $objModel = new GardenModel();
            $success = $objModel->clearBasketDB();
            return ($success);

        }


    }

