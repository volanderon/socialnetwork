<div id="tab-images" class="box">
    <div class="box-title">
        <img class="box-user-icon" src="user_content/photos/<?php echo $_SESSION['auth']['user_profile_picture']; ?>">
        Profile Settings
    </div>
    <div class="box-subTitle">
        Change your account picture
    </div>
    <div class="box-subTitle">
        <img src="user_content/photos/<?php echo $_SESSION['auth']['user_profile_picture']; ?>">
        <input id="photo-input" type="file" name="photo">
        <button id="upload-photo-btn" name="uploadPhoto">Upload Photo</button>
    </div>
    <div class="box-subTitle">
        <img class="box-user-icon" src="">
        <input id="cover-input" type="file" name="cover">
        <button id="upload-cover-btn" name="uploadCover">Upload Cover</button>
    </div>
</div>