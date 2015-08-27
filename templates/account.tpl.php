<?php require_once 'partials/header.tpl.php'; ?>

<div id="account-page" class="clear-fix">
    <div id="left-section">

        <?php require_once 'partials/account_general.tpl.php'; ?>
        <?php require_once 'partials/account_images.tpl.php'; ?>
        <?php require_once 'partials/account_password.tpl.php'; ?>

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

<?php require_once 'partials/footer.tpl.php'; ?>