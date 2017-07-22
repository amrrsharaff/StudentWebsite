<?php
//include
require("functions.php");
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    //Initialize session
    session_start();
    if(isset($_SESSION["email"])){
        $email = $_SESSION["email"];
        if (isset($_GET["email"])){
            $email = $_GET["email"];
        }
        if($_GET["email"] == $_SESSION["email"]){
            $is_user = true;
        }
        else{
            $is_user = false;
        }
        //Look up titles of projects (side) in table
        $projects = get_projects($email);
        //Look up titles of account's main projects in table
        $my_projects = get_myprojects($email);
        //render projects-form
        render("projects-form.php", ["title" => "Projects", "projects" => $projects, 
            "my_projects" => $my_projects, "email" => $email, "is_user" => $is_user]);
    } else{
        $email = $_GET["email"];
        $is_user = false;
        $projects = get_projects($email);
        $my_projects = get_myprojects($email);
        render("projects-form.php", ["title" => "Projects", "projects" => $projects, 
            "my_projects" => $my_projects, "email" => $email, "is_user" => $is_user]);
    }
} else{
    redirect("login.php");
}