Validate Email:
<form name= "email validator" onsubmit="return validateForm()"
    action="validate.php" method="post"> 
    <input type="text" name="email"><br>
    <span class="error"><?php echo "$emailErr";?></span>
    <input type="submit" value="Validate" name="login" />
</form>
<script>
    function validateForm() {
        var x = document.forms["email validator"]["email"].value;
        if (x.length == 0) {
            alert("Email must be filled out");
            return false;
            //uncomment this when running the real version
        
        } else if (x.slice(-17) !== "@mail.utoronto.ca"){
            alert("Email must be a uoft email.")
            return false;
        }
    }
</script>
