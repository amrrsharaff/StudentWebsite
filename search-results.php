<?php
require("functions.php");
session_start();
//Store input of user
$input = $_POST["input"];
//$input = "A";
//fetch the rows returned
$myresults = get_matches("Account", "name", $input);
echo'<dl>';
echo'<dt>Users:</dt>';
if($myresults->num_rows == 0) {
    // row not found
    echo 'No user is found.';
}
//go through each row and print the results as options of drop-down-list.
while($row = $myresults->fetch_assoc()){
    if($row["email"] == $_SESSION["email"]){
        continue;
    }
    echo'<dt class="text">'.'<a class="button" href=profile.php?email='.$row["email"].'>'.$row["name"].'</a> ('.$row["program"].') </dt>';
    //echo $row["name"];
echo'</dl>';
}