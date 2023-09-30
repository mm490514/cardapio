<?php
include_once 'config/Database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["cart"])) {
   
    $foodId = $_POST["foodId"];
    $newCustomization = $_POST["customization"];   

    foreach ($_SESSION["cart"] as $key => $value) {
        if ($value["food_id"] == $foodId) {
            $_SESSION["cart"][$key]["customization"] = $newCustomization;
            break; 
        }
    }
}
?>