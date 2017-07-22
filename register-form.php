<form action="confirmation.php" method="post">
            <fieldset>
                <legend>Registration information:</legend>
                <p>Email: <?php echo($email); ?></p>
                Name:<input type="text" name="name"><br>
                Password:<input type="password" id="pass1" name="password" onkeyup="myFunction()"><br>
                Confirm Password:<input type="password" id="pass2"  name="password2" onkeyup="myFunction()"><br>
                <span class="error" id="spanpass"></span><br>
                Faculty: <select id="faculty" name="faculty" onmouseover="myProgram()">
                            <option>Faculty Of Engineering</option>
                            <option>Faculty Of Arts&Science</option>
                            <option>Faculty of Architecture</option>
                            <option>Faculty of Dentistry</option>
                         </select>
                Program:<select name="program" id="program">
                      </select>
                Year: <select name="year">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                      </select>
                Campus:<select name="campus" size="1">
                    <option>St. George</option>
                    <option>Scarborough</option>
                    <option>Missisauga</option>
                       </select>
                <input id="submit" type="submit">
            </fieldset>
        </form>
                <script>
                    function myProgram(){
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                          if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("program").innerHTML = this.responseText;
                          }
                        };
                        xhttp.open("POST", "program_list.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                        var faculty = document.getElementById("faculty").value;
                        xhttp.send("faculty=".concat(faculty));
                    }
                    function myFunction() {
                        //myProgram();
                        var x = document.getElementById("pass1").value;
                        var y = document.getElementById("pass2").value;
                        if(x == ""){
                            document.getElementById("spanpass").innerHTML = "Please fill in the password";
                            document.getElementById("submit").disabled= true;
                        }
                        else if(x !== y){
                            document.getElementById("spanpass").innerHTML = "Passwords do not match";
                            document.getElementById("submit").disabled= true;
                        }
                        else{
                            document.getElementById("spanpass").innerHTML = "Passwords match";
                            document.getElementById("submit").disabled= false;
                        }
                        }
                    
                </script>

