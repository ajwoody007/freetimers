<?php

class GardenModel {

    private function dbConn() {

        $user = "root";
        $pass = "";
        $host = "127.0.0.1";
        $db_name = "db_garden";

        $connection_info = ['host' => $host, 'user' => $user, 'pass' => $pass, 'dbname' => $db_name];

        $host='mysql:host=' . $connection_info['host'] . ';dbname=' . $connection_info['dbname'];
        $db = new PDO($host,$connection_info['user'],$connection_info['pass']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return($db);

    }

    private function disConnDB() {
        $cnn=null;
        return;
   }

    public function newCalculation($area_data ) {

        $area_unit = $area_data['area_unit'];
        $depth_unit = $area_data['depth_unit'];
        $area = $area_data['area'];
        $depth = $area_data['depth'];
        $calculated_area = $area_data['calculated_area'];
        $calculated_bags = $area_data['calculated_bags'];
        $total_cost = 0;
        unset($_SESSION['total_cost']);

        // get the cost for the number of bags before creating a new record

        $arr_price_per_bag = $this->getPricePerBag();

        if ($arr_price_per_bag) { $total_cost = $arr_price_per_bag * $calculated_bags; $_SESSION['total_cost'] = $total_cost; }

        $insert_query = '
            INSERT INTO tbl_calculations 
                (area_units, depth_units, area, depth, total_area, total_bags, total_cost)
            VALUES
                (
                    "' . $area_unit . '",
                    "' . $depth_unit . '",
                    ' . $area . ',
                    ' . $depth . ',
                    ' . $calculated_area . ',
                    ' . $calculated_bags . ',
                    ' . $total_cost . '
                )
            ';

        // connect to the database

        $cnn = $this -> dbConn();
        $saveRecord = $cnn->prepare($insert_query);
        $success = $saveRecord->execute();        
        $this->disConnDB();
        return($success);

    }

    public function getPreviousValuesDB() {

        $select_query = 'SELECT * FROM tbl_calculations';

        $cnn = $this -> dbConn();
        $dsCalculations = $cnn -> query($select_query) ;
        $this->disConnDB();
        return($dsCalculations);

    }

    public function addToBasketDB() {

        // insert a new row into the basket

        $insert_query = 'INSERT INTO tbl_basket (total, cost) VALUES (' . $_SESSION['actual_bags'] . ',' . $_SESSION['total_cost'] . ' )';

        $cnn = $this -> dbConn();
        $saveRecord = $cnn->prepare($insert_query);
        $success = $saveRecord->execute();        
        $this->disConnDB();
        return($success);

    }

    public function getBasketTotalDB() {

        $select_query = 'SELECT sum(total) total, sum(cost) cost FROM tbl_basket';

        $cnn = $this -> dbConn();
        $dsTotal = $cnn -> query($select_query) ;
        $this->disConnDB();
        return($dsTotal);

    }

    public function clearBasketDB() {

        $delete_query = 'DELETE FROM tbl_basket';
        $cnn = $this -> dbConn();
        $saveRecord = $cnn->prepare($delete_query);
        $success = $saveRecord->execute();        
        $this->disConnDB();
        return($success);

    }

    public function getPricePerBag() {

        $select_query = 'SELECT bag_cost FROM pl_bag_cost';

        $cnn = $this -> dbConn();
        $dsBagCost = $cnn -> query($select_query) ;
        $arrBagCost = $dsBagCost->FETCH(PDO::FETCH_COLUMN);
        $this->disConnDB();
        return($arrBagCost);



    }

}

