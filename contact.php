<?php
require("functions.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $_SESSION["receiver"] = $_GET["email"];
    render("contact-form.php", ["title" => "Connect :)", "receiver" => $_GET["email"]]);
}
else{
    notify($_SESSION["receiver"], $_POST["subject"], $_POST["body"], $_SESSION["email"]);
    redirect("profile.php?email=".$_SESSION["receiver"]);
}

