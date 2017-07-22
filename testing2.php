<?php
    require("functions.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    echo"hi";
    }
    else{
        redirect("login.php");
    }
?> 
