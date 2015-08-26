<?php include_once 'inc/guard.php'; ?>
<?php include_once 'inc/header.php'; ?>

    <div id="account-page">
        <div id="left-section">

            <?php include_once 'inc/account_general.php'; ?>
            <?php include_once 'inc/account_images.php'; ?>
            <?php include_once 'inc/account_password.php'; ?>

        </div>


        <div id="right-section">

            <div id="account-tabs" class="box">

                <div class="box-title">
                    Settings
                </div>
                <div class="box-subTitle" data-tab="general">
                    General
                </div>
                <div class="box-subTitle" data-tab="images">
                    Profile Picture
                </div>
                <div class="box-subTitle" data-tab="password">
                    Password
                </div>

            </div>

        </div>
    </div>

<?php include_once 'inc/footer.php'; ?>