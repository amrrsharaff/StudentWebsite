<?php
    require("functions.php");
    session_start();
    if(empty($_SESSION["email"])){
        redirect("logout.php");
    }
    else if($_SERVER["REQUEST_METHOD"] == "GET"){
        render("main-form.php", ["title" => "Main"]);
    }

