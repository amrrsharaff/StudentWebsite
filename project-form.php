<h1> Project title: <?php echo $row["title"]; ?> </h1>
        <h3> Head of project:<a href="profile.php?email=<?php echo $row["head"];?>"> <?php echo profile($row["head"])["name"]; ?></a></h3>
        <div>
            <p>
                <?php echo $row["summary"]?>
            </p>
            <h4>Members</h4>
            <?php if($is_head):?>
            <button>Email members</button>
            <?php endif;?>
            <dl>
                <?php
                    foreach ($members as $value) {
                        if(check($value, "Account") == false){ 
                            echo("<dt><a href='profile.php?email=".$value."'>".
                                  $value
                                . "</a></dt>"
                                );
                        }
                        else{
                            echo("<dt>".
                                  $value
                                . "</dt>"
                                );
                        }
                    }
                ?>
            </dl>
        </div>
        <div>
            <?php echo"<h4>images</h4>";?>
        </div>