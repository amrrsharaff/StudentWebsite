<?php
        session_start(); 
        require "functions.php";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            register($_SESSION["email"], $_POST["password"], $_POST["name"], $_POST["program"]
            , $_POST["year"], $_POST["campus"]);
            waitlist($_POST["email"], 1);
            redirect("profile.php");
        }
        else{
            session_unset();
            session_destroy();
            redirect("login.php");
        }
?>
