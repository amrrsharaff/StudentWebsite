<?php 
    require("functions.php");
    session_start();
    $pid = $_GET['id']; //get id by get
    $row = get_project($pid);
    //Check whether user is head
    if(isset($_SESSION["email"]) and $row["head"] == $_SESSION["email"]){
        $is_head = true;
    } else{
        $is_head = false;
    }
    $members = explode("-", $row["emails"]);
    render("project-form.php", ["pid" => $pid, "row" => $row, "members" => $members,
            "is_head" => $is_head]);
?>