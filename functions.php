<?php

    /*
     * Helper functions.
     */

    require_once("constants.php");

    /**
     * Apologizes to user with message.
     */
    function apologize($message)
    {
        render("apology.php", ["message" => $message]);
        exit;
    }

    /**
     * Facilitates debugging by dumping contents of variable
     * to browser.
     */
    function dump($variable)
    {
        require("../templates/dump.php");
        exit;
    }
    /**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */
    function logout()
    {
        // unset any session variables
        $_SESSION = [];

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
    }
    /**
     * Redirects user to destination, which can be
     * a URL or a relative path on the local host.
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     **/
    function redirect($destination)
    {
        // handle URL
        if (preg_match("/^https?:\/\//", $destination))
        {
            header("Location: " . $destination);
        }

        // handle absolute path
        else if (preg_match("/^\//", $destination))
        {
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
        }

        // handle relative path
        else
        {
            // adapted from http://www.php.net/header
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
        }

        // exit immediately since we're redirecting anyway
        exit;
    }

    /**
     * Renders template, passing in values.
     */
    function render($template, $values = [])
    {
        // if template exists, render it
        if (file_exists("$template"))
        {
            // extract variables into local scope
            extract($values);
            // render header
            require("header.php");

            // render template
            require("$template");

            // render footer
            if($template == "login-form.php" or empty($_SESSION["email"]) or check($_SESSION["email"], "Account")){
                require("footer_1.php");
            }
            else{
                require("footer.php");
            }
        }

        // else err
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }
    function connect(){
            	$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "Projects";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
		} 
                $conn->close();
        }
    function query($statement){
                $servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "Projects";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = $statement;
		if ($conn->query($sql) === TRUE) {
                    //echo "Query Successful";
		} else {
                    //echo "Error updating record: " . $conn->error;
		}
                $conn->close();
	}
    function register($email, $password, $name, $program, $year, $campus){
		query("INSERT INTO Login (email, password)
                    VALUES ('$email', '$password')");
                //echo " ";
                query("INSERT INTO Account (name, email, program, year, campus)
                    VALUES ('$name', '$email', '$program', '$year', '$campus')");
	}
    function check($email, $table){
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "Projects";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $sql = "SELECT email FROM $table WHERE email = '$email'";
                $result = $conn->query($sql);
                $conn->close();
                if($result->num_rows == 0) {
                // row not found
                    return TRUE;
                } else {
                    return FALSE;
                }
        }
    function profile($email){
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "Projects";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM Account WHERE email = '$email'";
                $result = $conn->query($sql);
                
                $row = $result->fetch_assoc();
                return $row;
        }
    function verify($address, $pass){
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "Projects";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $sql = "SELECT * FROM Login WHERE email = '$address'";
                $result = $conn->query($sql);
                $conn->close();
                if($result->num_rows == 0) {
                // row not found
                    return FALSE;
                } elseif ($result->fetch_assoc()["password"] != $pass) {
                    return FALSE;
                } else {
                    return TRUE;
                }
        }
    function change_pic($email, $picture){
                query("UPDATE Account
                       SET image='$picture'
                       WHERE email='$email'");
        }
    function confirm($email){
            require '../mailer/PHPMailerAutoload.php';

            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com;smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'amrmagdy.sharaf@gmail.com';                 // SMTP username
            $mail->Password = 'redamroz';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('blackboardlearn@gmail.com');
            $mail->addAddress($email);     // Add a recipient
            #$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('info@example.com', 'Information');

                #$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                #$mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Confirmation';
            $mail->Body    = 'Thank you for joining our powerful community. Please go to '. 
                             'http://localhost:8888/register.php?email='.explode("@",$_SESSION["email"])[0].
                             '%40mail.utoronto.ca'.
                             ' to continue with the registration process.';
            #$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }

        }
    function notify($receiver, $subject, $body, $sender){
            require '../mailer/PHPMailerAutoload.php';

            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com;smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'amrmagdy.sharaf@gmail.com';                 // SMTP username
            $mail->Password = 'redamroz';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('blackboardlearn@gmail.com');
            $mail->addAddress($receiver);     // Add a recipient
            #$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('info@example.com', 'Information');

                #$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                #$mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Confirmation';
            $mail->Body    = "This email is sent by: ".$sender."\n"
                    . "Subject: $subject \n". "$body";
            #$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }

        }
    function get_projects($email){
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "Projects";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT title, summary, pid
                        FROM Project
                        WHERE emails LIKE '%$email%'";
                $result = $conn->query($sql);
                return $result;
        }
    function get_myprojects($email){
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "Projects";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT title, summary, pid
                        FROM Project
                        WHERE head = '$email'";
                $result = $conn->query($sql);
                return $result;
        }
    function get_project($pid){
        //returns a dictionairy containing data of project
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "Projects";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT head, summary, title, emails
                        FROM Project
                        WHERE pid = $pid";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                return $row;
        }
        
    function waitlist($email, $num){
            /* Adds or deletes <email> from waitlist Table.
             * If num == 0 -> Add email to waitlist
             * If num == anything else -> Delete email from waitlist
             * This function is used in validate when someone is sent an email
             * his email is added to the waitlist, and when he clicks on the link
             * in the email sent to his address, his address is removed.
             */
            if ($num == 0){
            query("INSERT INTO Waitlist (email) VALUES ('$email')");
            }
            else {
            query("DELETE FROM Waitlist WHERE email='$email';");
            }
        }
    function add_project($title, $summary, $head_email, $emails, $category){
            //adds project to database
            $statement = "INSERT INTO Project (title, summary, head, emails, category) "
                    . "VALUES ('$title', '$summary', '$head_email', '$emails', '$category')";
            query($statement);
            $head_profile = profile($head_email);
            $new_projects = $head_profile["number_projects"] + 1;//Increment
            //Update number of projects coloumn in table(update user's profile)
            $statement = "UPDATE Account
                       SET number_projects='$new_projects'
                       WHERE email='$head_email'";
            query($statement);
        }
    function get_matches($table, $column, $value){
                /* Returns the rows in table where coloumn is equal to value
                 * Used in search-results.php to get matches for input search.
                 * The returned value must be fetched in a loop as following
                 * while($row = $my_projects->fetch_assoc())
                 * $row is a dictionairy with keys as columns.
                 * 
                 */
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "Projects";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT *
                        FROM $table
                        WHERE $column LIKE '%$value%'";
                $result = $conn->query($sql);
                return $result;
    }

?>
