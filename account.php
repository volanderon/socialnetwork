<?php include_once 'inc/guard.php'; ?>
<?php include_once 'inc/header.html'; ?>


    <div id="left-section">

        <div class="box">

            <div class="box-title">
                <img class="box-user-icon" src="">
                General Settings
            </div>
            <div class="box-subTitle">
                Edit your profile information
            </div>

            <form id="account-form" data-birthdate="<?php echo $_SESSION['auth']['user_birthdate'] ?>">

                <div id="update-user-error" class="error">
                    Error<br>
                    <span></span>
                </div>
                <div>
                    <div>First Name</div>
                    <input type="text" name="firstName" value="<?php echo $_SESSION['auth']['user_firstname'] ?>" required>
                    <div>Enter your first name</div>
                </div>
                <div>
                    <div>Last Name</div>
                    <input type="text" name="lastName" value="<?php echo $_SESSION['auth']['user_lastname'] ?>" required>
                    <div>Enter your last name</div>
                </div>
                <div>
                    <div>Email</div>
                    <input type="email" name="email" value="<?php echo $_SESSION['auth']['user_email'] ?>" required>
                    <div>E-mail will not be displayed</div>
                </div>
                <div>
                    <div>Birth Date</div>
                    <select id="birth-day" name="birthDay"></select>
                    <select id="birth-month" name="birthMonth"></select>
                    <select id="birth-year" name="birthYear"></select>
                    <div>Select the date you were born</div>
                </div>
                <div>
                    <div>Gender</div>
                    <select name="gender">
                        <option value="0">No Gender</option>
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
                    <textarea rows="5" cols="50" name="about" required><?php echo $_SESSION['auth']['user_about'] ?></textarea>
                    <div>About you (160 characters or less)</div>
                </div>
                <button id="update-user-btn" name="saveChanges">Save Changes</button>


            </form>

        </div>
        
    </div>


    <div id="right-section">

        <div class="box">

            <div class="box-title">
                Settings
            </div>
            <div class="box-subTitle">
                General
            </div>
            <div class="box-subTitle">
                Profile Picture
            </div>
            <div class="box-subTitle">
                Password
            </div>

        </div>

    </div>

<?php include_once 'inc/footer.html'; ?>