<?php session_start() ; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Freetimers Test</title>
        <link rel="stylesheet" type="text/css" href="../resources/css/garden.css" />
        <script src="../resources/js/jquery-3.4.1.js"></script>   
        <script src="../resources/js/garden.js"></script>     
</head>

<body>

<?php 

    include_once("../controller/nav.php");

?>

<h1>Result</h1>

<?php

    $actual_bags = 0;
    $total_cost = 0;

    if ($_SESSION['actual_bags']){ $actual_bags = $_SESSION['actual_bags']; }
    if ($_SESSION['total_cost'] ){ $total_cost = $_SESSION['total_cost']; }

?>

<p>You will need <?= $_SESSION['actual_bags']; ?> bags for this job at a total cost of £<?= number_format($total_cost,2); ;?> </p>

<br><br>
<form method="POST">

    <button name='reset_calc_garden' type="submit">Reset</button>
   
</form>
<div class='container'>

    <a href='' onclick='gc.addToBasket()'>Add to basket</a>

    <br><br>

    <?php 

        $basket_count = 0;
        $total_cost = 0;
        include_once("../controller/GardenClass.php");

        $objGardenClass=new GardenClass();
        $dsBasket = $objGardenClass->getBasketTotal();
        $arrBasket = $dsBasket->fetch(PDO::FETCH_ASSOC);

        if ($arrBasket) { 
            $basket_count = $arrBasket['total'];
            $total_cost = $arrBasket['cost'];
        }

    ?>

    There are <?= $basket_count; ?> items in your basket at a price of £<?= number_format($total_cost); ?>.

    <br><br>

    <?php if ($basket_count > 0) { ?>

        <a href='' onclick='gc.clearBasket()'>Clear basket</a>

    <?php } ?>
        

</div>