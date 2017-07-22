<?php 
    require("functions.php");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        //any user is logged in
        if(isset($_SESSION["email"])){
            //check if this profile is the same as the user's profile
            if(isset($_GET["email"]) and $_GET["email"] == $_SESSION["email"]){
                $this_email = $_SESSION["email"];
            }
            //check if this profile is for another account than the user's
            else if(isset ($_GET["email"])){
                $this_email = $_GET["email"];
            }
            //if the profile is not indicated
            else{
                $this_email = $_SESSION["email"];
            }
            render("profile-form.php", ["title" => "Welcome back!", "email" => $this_email]);
        }
        //no user is logged in
        else{
            if(isset($_GET["email"])){
                $this_email = $_GET["email"];
                render("profile-form.php", ["title" => "Take a look!", "email" => $this_email]);
            }
            else{
                redirect("login.php");
            }
        }
   }