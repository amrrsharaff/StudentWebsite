<h1 class="text">Hello, <?php
                session_start();
                echo profile($_SESSION["email"])["name"];
?>
</h1>
<fieldset>
<input type="text" id='search' name='search' placeholder="Search by name" onkeyup="showNames()">
                <script>
                    function showNames() {
                      var xhttp = new XMLHttpRequest();
                      xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          document.getElementById("matches").innerHTML = this.responseText;
                        }
                      };
                      xhttp.open("POST", "search-results.php", true);
                      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                      var input = document.getElementById("search").value;
                      xhttp.send("input=".concat(input));
                      }
                </script>
<div name="matches" id="matches" >
</div>
</fieldset>