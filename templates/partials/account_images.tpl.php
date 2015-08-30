<div id="tab-images" class="box">
    <div class="box-title">
        <img class="box-user-icon" src="user_content/photos/<?php echo $_SESSION['auth']['user_profile_picture']; ?>">
        Profile Settings
    </div>

    <div class="box-subTitle">
        <div class="success">
            Success
        </div>
        Change your account picture
    </div>

    <div class="box-updateImg">

        <img id="photo-img" src="user_content/photos/<?php echo $_SESSION['auth']['user_profile_picture']; ?>">

        <div class="updateImg">
            <input id="photo-input" type="file" name="photo"><br>
            <button id="upload-photo-btn" name="uploadPhoto">Upload Photo</button>
        </div>

    </div>

    <div class="box-subTitle">
        Change your cover picture
    </div>

    <div class="box-updateImg">

        <img id="cover-img" src="user_content/covers/<?php echo $_SESSION['auth']['user_secret_picture']; ?>">

        <div class="updateImg">
            <input id="cover-input" type="file" name="cover"><br>
            <button id="upload-cover-btn" name="uploadCover">Upload Cover</button>
        </div>

    </div>
</div>