        <?php
            $row = profile($email);
        ?>
        <h1 class="heading">Name: <?php echo $row["name"]; ?></h1>
        <div>
            <img src="uploads/<?php echo $row["image"] ?>" alt="Profile Pic">
            <h2 class="text">Major: <?php echo $row["program"]; ?></h2>
            <h3 class="text">Campus: <?php echo $row["campus"]; ?></h3>
            <h4 class="text">Year: <?php echo $row["year"]; ?></h4>
            <h5 class="text">Number of projects: <?php echo $row["number_projects"]; ?></h5>
            <a class="text"> Contact info: <?php echo $row["email"]; ?></a>
        </div><br><br><br><br><br>
         <?php if($_SESSION["email"] == $email):?>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input class="button" type="file" name="fileToUpload" id="fileToUpload"><br>
                <input class="button" type="submit" value="Change DP" name="submit">
            </form>
        <?php endif ?>
        <div class="buttons">
        <a class="button" href="<?php echo"projects.php?email=$email"; ?>"> Projects</a><a class="button" href="javascript:history.go(-1);">Back</a><a class="button" href="<?php echo"contact.php?email=".$row['email'];?>">Contact</a><br>
        </div>