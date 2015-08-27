<!DOCTYPE HTML>

<html>

<head>

    <link rel="shortcut icon" type="image/png" href="images/favicon.ico"/>
    <title>Welcome to Socialily+ - Register, Login</title>
    <link rel="stylesheet" href="css/basis.css">
    <link rel="stylesheet" href="css/header.css">
    <script src="script/jquery-2.1.4.min.js"></script>
    <script src="script/utils.js"></script>
    <script src="script/index.js"></script>

</head>

<body>

<div id="index-page">
    <div id="header-wrapper">
        <header>

            <div class="logo"><a href="index.php"></a></div>
            <div class="header-menu">
                <div class="menu-visitor">Hello <strong>Visitor</strong></div>
            </div>

        </header>
    </div>

    <div id="wrapper">

        <div id="index-wrapper">
            <main>

                <div id="welcome">
                    <h1>Welcome</h1>

                    <p class="p1">To sociality+, JohnBryce's social network</p>

                    <p class="p2">Share your memories, connect with others, make new friends.</p>
                </div>

                <div id="forms">
                    <form id="register">

                        <h1>Sign Up</h1>

                        <div id="reg-error" class="error">Error<br>
                            <span></span>
                        </div>
                        <input name="first_name" type="text" placeholder="First Name" pattern="[a-zA-Z]+"
                               required><br>
                        <input name="last_name" type="text" placeholder="Last Name" pattern="[a-zA-Z]+"
                               required><br>
                        <input name="email" type="email" placeholder="Email" required><br>
                        <input name="password" type="password" placeholder="Password" minlength="4" required><br>
                        <input name="password_confirm" type="password" placeholder="Repeat Password" minlength="4"
                               required><br>
                        <input id="reg-btn" type="submit" name="register" value="REGISTER">

                    </form>

                    <form id="login">

                        <div id="login-error" class="error">Error<br>
                            <span></span>
                        </div>
                        <input type="email" name="email" placeholder="Email" required><br>
                        <input type="password" name="password" placeholder="Password" minlength="4" required><br>
                        <input id="login-btn" type="submit" name="login" value="LOGIN">

                    </form>
                </div>

            </main>
        </div>
    </div>

<?php require_once 'partials/footer.tpl.php' ?>