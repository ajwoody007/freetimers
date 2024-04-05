
<?php session_start() ; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Freetimers Test</title>
        <link rel="stylesheet/less" type="text/css" href="../resources/css/garden.less" />
        <script src="../resources/js/jquery-3.4.1.js"></script>    
        <script src="../resources/js/garden.js"></script>     
</head>

<?php 

    include_once("../controller/nav.php");
    include_once("../controller/GardenClass.php");
    $objGarden = new GardenClass();

?>

<body>
    <H1>Andy Wood - Technical Test for Freetimers</h1>
    <form method="POST"  >

        <?php

            if (isset($_SESSION['area_unit'])) {$unit = $_SESSION['area_unit']; } else {$_SESSION['area_unit'] = "ft"; $unit = "ft"; }
            if (isset($_SESSION['depth_unit'])) {$depth_unit = $_SESSION['depth_unit']; } else {$_SESSION['depth_unit'] = "in"; $depth_unit = "in"; }

            $m_selected = '';
            $ft_selected = '';
            $yd_selected = '';
            $cm_selected = '';
            $in_selected = '';
            
            switch ($unit) {
                case "m":
                    $m_selected = "selected";
                    $chosen_unit = "meters";
                    break;
                case "ft":
                    $ft_selected = "selected";
                    $chosen_unit = "feet";
                    break;
                case "yd":
                    $yd_selected = "selected";
                    $chosen_unit = "yards";
                    break;
                default:
                    $chosen_unit = "feet";
                    break;
            }

            switch ($depth_unit) {
                case "cm":
                    $cm_selected = "selected";
                    $chosen_depth_unit = "centimeters";
                    break;
                case "in":
                    $in_selected = "selected";
                    $chosen_depth_unit = "inches";
                    break;
                default:
                    $chosen_depth_unit = "inches";
                    break;                    
            }

        ?>
        
        Select units for area   
        <select name="area_units" id="area_units" onchange='gc.selectUnits()'>
            <option></option>

            <option value="m" <?= $m_selected; ?>>Metres</option>
            <option value="ft" <?= $ft_selected ?>>Feet</option>
            <option value="yd" <?= $yd_selected ?>>Yards</option>

        </select>

        <br><br>

        Select units for depth   
        <select name="depth_units" id="depth_units" onchange='gc.selectDepthUnits()'>
            <option></option>

            <option value="cm" <?= $cm_selected; ?>>Centimeters</option>
            <option value="in" <?= $in_selected ?>>Inches</option>

        </select>

        <br><br>        

        <label for="area">Enter area in <?= $chosen_unit; ?>:</label>
        <input name="area" /><span> <?= $unit; ?></span>

        <br><br>

        <label for="depth">Enter depth in <?= $chosen_depth_unit; ?>:</label>
        <input name="depth" /><span> <?= $depth_unit; ?></span>

        <br><br>

        <button name='calc_garden' type="submit">Calculate</button>

    </form>

            <!-- display previous values in a table -->

            <?php
            $dsCalculations = $objGarden->getPreviousValues();
            $calculations = 0; if ($dsCalculations) { while ($calculation = $dsCalculations->fetch(PDO::FETCH_ASSOC)) { $calculations++ ; } $dsCalculations->execute(); }
    
            if ($calculations > 0) {

                echo "<h1>Previous Results</h1>";

                echo "<table>";

                echo "<th>ID</th>";
                echo "<th>Area units</th>";
                echo "<th>Depth units</th>";
                echo "<th>Area</th>";
                echo "<th>Depth</th>";
                echo "<th>Total Area</th>";
                echo "<th>Total Bags</th>";
                echo "<th>Total Cost</th>";

                while ($calculation = $dsCalculations->fetch(PDO::FETCH_ASSOC)) {

                ?>

                    <tr>

                    <td><?= $calculation['calculation_id'] ; ?></td>
                    <td><?= $calculation['area_units'] ; ?></td>
                    <td><?= $calculation['depth_units'] ; ?></td>
                    <td><?= $calculation['area'] ; ?></td>
                    <td><?= $calculation['depth'] ; ?></td>
                    <td><?= $calculation['total_area'] ; ?></td>
                    <td><?= $calculation['total_bags'] ; ?></td>
                    <td><?= $calculation['total_cost'] ; ?></td>

                    </tr>

                <?php

                }

                    echo "</table>";

            } else {

                echo "There are no results to display.";

            }

            ?>

</body>
</html>
