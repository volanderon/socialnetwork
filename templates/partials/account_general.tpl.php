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
            <div>Gender</div>
            <select name="gender" required>
                <option value="">No Gender</option>
                <option value="1">Male</option>
                <option value="2">Female</option>
            </select>
            <div>Select your gender (male or female)</div>
        </div>
        <div>
            <div>Location</div>
            <input type="text" name="location">
            <div>Where do you live?</div>
        </div>
        <div>
            <div>Website</div>
            <input type="url" name="website">
            <div>If you have a blog, personal page, enter it</div>
        </div>
        <div>
            <div>About Me</div>
            <textarea rows="5" cols="50" name="about" maxlength="160" required><?php echo $_SESSION['auth']['user_about'] ?></textarea>
            <div>About you (160 characters or less)</div>
        </div>
        <button id="update-user-btn" name="saveChanges">Save Changes</button>


    </form>

</div>