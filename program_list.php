<?php
    $faculty = $_POST["faculty"];
    if($faculty == "Faculty of Dentistry" or $faculty == "Faculty of Architecture"){
        if($faculty == "Faculty of Dentistry"){
            echo("<option>Dentistry</option>");
        }
        else{
            echo("<option>Architecture</option>");
        }
    } else{
        if($faculty == "Faculty Of Engineering"){
            $file = "Engprograms.txt";
        }
        else{
            $file = "Art.txt";
        }
        $myfile = fopen($file, "r") or die("Unable to open file!");
        //Read one line until end-of-file
        while(!feof($myfile)) {
            echo("<option>".fgets($myfile)."</option>");
        }
        fclose($myfile);
    }