<div class="clear-fix box">
    <div class="box-title">My Details</div>
    <div class="details bold">
        <span class="user-fullName"><?php echo $_SESSION['auth']['user_firstname'] . ' ' . $_SESSION['auth']['user_lastname']; ?></span><br>
        <span class="user-birthDate"><?php echo $_SESSION['auth']['user_birthdate_hebrew'] ?></span>
        <span class="user-age">(<?php echo $_SESSION['auth']['age'] ?>)</span><br>
        <span class="user-email"><?php echo $_SESSION['auth']['user_email']; ?></span><br>
    </div>
</div>