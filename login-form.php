<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
        <fieldset>
            <form action="login.php" method="post">
                <a class="text">Login</a><br>
                <a class="text">Email: <input type="text" name="email"></a><br>
                <a class="text">Password: <input type="password" name="password"></a><br>
                <input type="submit" value="Log in" name="login" /> Or
                <a class="button" href="validate.php">Register!</a><br>
                <span class="error" id="error"><?php echo $errMessage;?> </span>
            </form>
        </fieldset>
