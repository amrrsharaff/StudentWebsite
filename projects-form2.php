        <form id="some_form" name="addProject" action="addproject.php" method="get">
            <fieldset>
                Title: <input type="text" name="title" placeholder="Project title"><br>
                Description:<br><textarea name="summary" placeholder="Write a summary of your project" rows="5" cols="50"></textarea>
                <br>
                Number of members: <input type="number" id="num_members" placeholder="eg. 3">
                <button type="button" onclick="getForms()">Write emails</button>
                <p id="demo"></p>
                <script>
                    function getForms() {
                      var xhttp = new XMLHttpRequest();
                      xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          document.getElementById("demo").innerHTML = this.responseText;
                        }
                      };
                      xhttp.open("POST", "getForms.php", true);
                      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                      var number = document.getElementById("num_members").value;
                      xhttp.send("t=".concat(number));
                      }
                </script>
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
        <h3><?php echo(profile($email)["name"]);?>'s projects:</h3>
        <dl>
           <?php
                //initialize counter
                $i = 1;
                //<a href="page.php?value_key=some_value">Link</a>
                //loop through each row return by fetch_assoc()
                //print title and summary
                while($row = $my_projects->fetch_assoc()){
                    echo("<dt>".$i.". <a href='project.php?id=".$row["pid"]."'>".
                            $row["title"]
                            . "</a></dt>"
                    );
                    echo("<dd>-".
                            $row["summary"]
                            ."</dt>"
                    );
                    $i++;
                }
            ?>
        </dl>
        <h4>Projects they participated/are participating in:</h4>
        <dl>
           <?php
                //initialize counter
                $i = 1;
                //<a href="page.php?value_key=some_value">Link</a>
                //loop through each row return by fetch_assoc()
                //print title and summary
                while($row = $projects->fetch_assoc()){
                    echo("<dt>".$i.". <a href='project.php?id=".$row["pid"]."'>".
                            $row["title"]
                            . "</a></dt>"
                    );
                    echo("<dd>-".
                            $row["summary"]
                            ."</dt>"
                    );
                    $i++;
                }
            ?>
        </dl>