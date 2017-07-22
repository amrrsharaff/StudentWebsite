<?php
    require("functions.php");
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if (empty($_GET["email"]) or check($_GET["email"], 'Waitlist')){
            redirect("login.php");
        }else{
            $_SESSION["email"] = $_GET["email"];
            render("register-form.php", ["title" => "Register", "email" => $_GET["email"]]);
        }
    }