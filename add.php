<?php if($_POST["add"] == "yes"):?>
       <form id="some_form2" name="addProject" action="addproject.php" method="get">
            <fieldset>
                Title: <input type="text" name="title" placeholder="Project title"><br>
                Description:<br><textarea name="summary" placeholder="Write a summary of your project" rows="5" cols="50"></textarea>
                <br>
                Members: <br><textarea name="emails" placeholder="Please write in the form: email@mail.com-email2@mail.com" rows="3" cols="50"></textarea>
                <br>
                Category: <select name="category">
                <?php
                    $myfile = fopen("Categories.txt", "r") or die("Unable to open file!");
                    // Read one line until end-of-file
                    while(!feof($myfile)) {
                        echo("<option>".fgets($myfile)."</option>");
                    }
                    fclose($myfile);
                ?>
                        </select>
                <input type="submit">
            </fieldset>
        </form>
<?php endif;?>
