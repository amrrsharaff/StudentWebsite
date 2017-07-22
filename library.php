<?php
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
                    echo "Query Successful";
		} else {
                    echo "Error updating record: " . $conn->error;
		}
                $conn->close();
	}
	function register($email, $password, $name, $program, $year, $campus){
		query("INSERT INTO Login (email, password)
                    VALUES ('$email', '$password')");
                echo " ";
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
                        WHERE head LIKE '%$email%'";
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
         
            if ($num == 0){ //add to waitlist
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
            
        }
        
?>