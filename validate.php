<?php
    require("functions.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(check($_POST['email'], 'Login') == FALSE) {
                $emailErr = "Email is already used";
                render("validate-form.php", ["emailErr" => $emailErr]);
            }
            else{
                session_start();
                $_SESSION['email'] = $_POST['email'];
                //confirm($_POST['email']);
                waitlist($_POST['email'], 0);
                /*render("email.php", ["title" => "Check your inbox!"]);
                </script>';
                Delete the following when running the real version of the 
                wesbsite and uncomment the past statement
                 * 
                 */
                redirect('register.php?email='.$_POST["email"]);
            }
    }
    else if ($_SERVER["REQUEST_METHOD"] == "GET"){
        render("validate-form.php", ["emailErr" => ""]);
    }
?>