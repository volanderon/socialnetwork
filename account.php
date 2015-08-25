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

            <div id="">

                First Name <input type="text" name="firstName"><br>
                Last Name <input type="text" name="lastName"><br>
                Email <input type="email" name="email"><br>
                Birth Date <input type="date" name="birthDate"><br>
                Gender <input type="text" name="gender"><br>
                Location <input type="text" name="location"><br>
                Website <input type="text" name="firstName"><br>
                About Me <input type="textarea" name="firstName"><br>
                <button name="saveChanges">Save Changes</button>


            </div>

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