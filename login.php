<?php 
        require("functions.php");
        //if user is redirected or write in link
        if ($_SERVER["REQUEST_METHOD"] == "GET"){
            //if user is logged in from before
            if(isset($_SESSION["email"])){
                redirect("profile.php");
            }
            //first time
            else{
                echo($_SESSION["email"]);
                render("login-form.php",["title" => "Log In"]);
            }
        }
        //if user attempted to log in by filling in the form
        elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            //if user left any empty field
            if(empty($_POST["email"]) or empty($_POST["password"])){
               apologize("Please fill in both your email and password.");
           }
            //if user is entered information correctly
            elseif(verify($_POST["email"], $_POST["password"])){
                $email = $_POST["email"];
                $started = session_start();
                $_SESSION["email"] = $email;
                redirect("profile.php");
            //if user entered information incorrectly or login failed
            }else{
                apologize("Wrong email or password.");
            }
        }
?>
