<?php
include_once 'config/Database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["cart"])) {
   
    $foodId = $_POST["foodId"];
    $newobservacao = $_POST["observacao"];   

    foreach ($_SESSION["cart"] as $key => $value) {
        if ($value["food_id"] == $foodId) {
            $_SESSION["cart"][$key]["observacao"] = $newobservacao;
            break; 
        }
    }
}
?>