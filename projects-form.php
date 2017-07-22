    <?php if($is_user):?>
        <form id="some_form" name="addProject" action="addproject.php" method="get">
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
        <h3 class="heading"><?php echo(profile($email)["name"]);?>'s projects:</h3>
        <dl>
           <?php
                //initialize counter
                $i = 1;
                //<a href="page.php?value_key=some_value">Link</a>
                //loop through each row return by fetch_assoc()
                //print title and summary
                while($row = $my_projects->fetch_assoc()){
                    echo("<dt>".$i.". <a class='button' href='project.php?id=".$row["pid"]."'>".
                            $row["title"]
                            . "</a></dt>"
                    );
                    echo("<dd class='projectSummary'>Summary: ".
                            $row["summary"]
                            ."</dt>"
                    );
                    $i++;
                }
            ?>
        </dl>
        <h4 class="heading">Projects they participated/are participating in:</h4>
        <dl>
           <?php
                //initialize counter
                $i = 1;
                //<a href="page.php?value_key=some_value">Link</a>
                //loop through each row return by fetch_assoc()
                //print title and summary
                while($row = $projects->fetch_assoc()){
                    echo("<dt>".$i.". <a class='button' href='project.php?id=".$row["pid"]."'>".
                            $row["title"]
                            . "</a></dt>"
                    );
                    echo("<dd class='projectSummary'>Summary: ".
                            $row["summary"]
                            ."</dt>"
                    );
                    $i++;
                }
            ?>
        </dl>
