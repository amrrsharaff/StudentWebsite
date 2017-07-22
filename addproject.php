<?php
require("functions.php");
if($_SERVER["REQUEST_METHOD"] == "GET"){
    session_start();
    $emails = $_GET["emails"];
    $head_email = $_SESSION["email"];
    $category = $_GET["category"];
    $summary = $_GET["summary"];
    $title = $_GET["title"];
    add_project($title, $summary, $head_email, $emails, $category);
    redirect("projects.php");
} else{
    if(isset($_SESSION["email"])){
        redirect("profile.php");
    } else{
        redirect("login.php");
    }
}