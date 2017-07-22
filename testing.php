<?php
require("functions.php");
//$to = "s.goksoy98@gmail.com";
$to = "denizakyildiz1997@gmail.com";
$subject = "Hatchery warning";

$message = "
This is a warning email after receiving a report about a violation to one of the rules which is consuming too much cold brew. Please respect other colleagues.
";

// Always set content-type when sending HTML email

// More headers
$headers =
    'From: The entrepreneurship hatchery <reports@hatchery.ca>' . "\r\n" .

mail($to,$subject,$message,$headers);
include 'footer.php';
?>
