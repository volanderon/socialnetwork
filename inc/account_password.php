<div id="tab-password" class="box">
    <div class="box-title">
        <img class="box-user-icon" src="user_content/photos/<?php echo $_SESSION['auth']['user_profile_picture']; ?>">
        Password Settings
    </div>
    <div class="box-subTitle">
        Change your password
    </div>
    <form id="change-password-form" class="account-form">
        <div class="error">
            Error<br>
            <span></span>
        </div>
        <div class="success">
            Success
        </div>
        <div>
            <div>Old Password</div>
            <input type="password" name="oldPassword" minlength="4" required>
        </div>
        <div>
            <div>New Password</div>
            <input type="password" name="newPassword" minlength="4" required>
        </div>
        <div>
            <div>Repeat New Password</div>
            <input type="password" name="repeatNewPassword" minlength="4" required>
        </div>
        <button id="change-password-btn" name="changePassword">Change Password</button>
    </form>
</div>