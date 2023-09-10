<?php
include ("includes/header.php");

?>
    <div class = "user_details coloumn">
        <a href="#"> <img src ="<?php echo $user['profile_pic'];?>"> </a>

        <div class ="user_details_left_right">
            <a href="#">
            <?php
                echo $user['first_name']." ".$user['last_name'];


            ?>
            </a>
            <?php echo "Posts : ". $user['num_posts']."<br>"; 
                echo "Likes : ". $user['num_likes']."<br>";
            ?>
        </div>

    </div>  

    <div class= "main_coloumn coloumn">
        <form class ="post_form" action="index.php" method = "POST">

            <textarea name="post_text" id="post_text" placeholder="What's On Your Mind Habibi ?"></textarea>
            <input type="submit" name ="post" id="post_button" value="Post">
            <hr>

        </form>
    </div>


</div>
</body>
</html>