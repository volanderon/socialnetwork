<?php include_once 'inc/guard.php'; ?>
<?php include_once 'inc/header.html'; ?>


    <div id="left-section">

        <div class="box update-status">

            <div class="box-title">
                <img class="box-user-icon" src="">
                <span class="user-firstName">[firstName], Update your status</span>
            </div>

            <textarea class="post-content" placeholder="What's on your mind?"></textarea>

            <div class="post-status">
                <input type="submit" name="post" value="Post">
            </div>

        </div>

        <div class="box post">

        </div>

    </div>

    <div id="right-section">

        <div class="box">
            <div class="box-title">Welcome</div>
            <img class="user-welcome-pic" src="">
            <div class="details">
                <span class="user-firstName">[firstName]</span><br>
                <a href="account.php">Edit Profile</a>
            </div>
        </div>

        <div class="box">
            <div class="box-title">My Details</div>
            <div class="details bold">
                <span class="user-fullName">[fullName]</span><br>
                <span class="user-birthDate">[birthDate]</span>
                <span class="user-age">([age])</span><br>
                <span class="user-email">[email]</span><br>
            </div>
        </div>

        <div class="box">
            <div class="box-title">Me Friends</div>
            <img class="friend-pic" src="">
            <img class="friend-pic" src="">
            <img class="friend-pic" src="">
            <img class="friend-pic" src="">
            <img class="friend-pic" src="">
            <img class="friend-pic" src="">
        </div>

    </div>


<?php include_once 'inc/footer.html'; ?>