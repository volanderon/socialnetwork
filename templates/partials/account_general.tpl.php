<div id="tab-general" class="box">

    <div class="box-title">
        <img class="box-user-icon" src="user_content/photos/<?php echo $_SESSION['auth']['user_profile_picture']; ?>">
        General Settings
    </div>
    <div class="box-subTitle">
        Edit your profile information
    </div>

    <form id="account-form" class="account-form" data-birthdate="<?php echo $_SESSION['auth']['user_birthdate'] ?>">

        <div class="error">
            Error<br>
            <span></span>
        </div>
        <div class="success">
            Success
        </div>
        <div>
            <div>First Name</div>
            <input type="text" name="firstName" value="<?php echo $_SESSION['auth']['user_firstname'] ?>" pattern="[a-zA-Z]+" required>
            <div>Enter your first name</div>
        </div>
        <div>
            <div>Last Name</div>
            <input type="text" name="lastName" value="<?php echo $_SESSION['auth']['user_lastname'] ?>" pattern="[a-zA-Z]+" required>
            <div>Enter your last name</div>
        </div>
        <div>
            <div>Email</div>
            <input type="email" name="email" value="<?php echo $_SESSION['auth']['user_email'] ?>" required>
            <div>E-mail will not be displayed</div>
        </div>
        <div>
            <div>Birth Date</div>
            <select id="birth-day" name="birthDay" required></select>
            <select id="birth-month" name="birthMonth" required></select>
            <select id="birth-year" name="birthYear" required></select>
            <div>Select the date you were born</div>
        </div>
        <div>
            <div>About Me</div>
            <textarea rows="5" cols="50" name="about" maxlength="160" required><?php echo $_SESSION['auth']['user_about'] ?></textarea>
            <div>About you (160 characters or less)</div>
        </div>

    </form>


    <div class="button-separator">
        <button id="update-user-btn" name="saveChanges">Save Changes</button>
    </div>

</div>