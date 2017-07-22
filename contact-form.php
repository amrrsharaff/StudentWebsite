Email: <?php $_GET["email"]?>
<fieldset id="email-form">
    <form action="contact.php" method="post">
        Subject: <input type="text" name="subject" placeholder="Please be specific" /><br>
        Email body: <textarea name="body" placeholder="Email body" rows="5" cols="50"></textarea>
       <input type="submit"/>
    </form>
</fieldset>
