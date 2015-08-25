<!DOCTYPE HTML>

<html>

<head>
    
    <title>Welcome to Socialily+ - Register, Login</title>
    <link rel="stylesheet" href="css/basis.css">
    <link rel="stylesheet" href="css/header.css">
    <script src="script/jquery-2.1.4.min.js"></script>
    <script src="script/utils.js"></script>
    <script src="script/account.js"></script>
    <script src="script/home.js"></script>
    <script src="script/index.js"></script>
    <script src="script/my_photos.js"></script>
    <script src="script/notifications.js"></script>
    <script src="script/post.js"></script>
    <script src="script/profile.js"></script>

</head>

<body>

        
    <div id="header-wrapper">
        <header>

            <div class="logo"></div>
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
                <div id="register">
                
                    <h1>Sign Up</h1>
                    <div class="error">Error<br>
                        <span>**Error shown here**</span>
                    </div>
                    <input type="text" placeholder="First Name"><br>
                    <input type="text" placeholder="Last Name"><br>
                    <input type="email" placeholder="Email"><br>
                    <input type="password" placeholder="Password"><br>
                    <input type="password" placeholder="Repeat Password"><br>
                    <input type="submit" name="register" value="REGISTER">
                    
                </div>
            
                <div id="login">
                
                    <input type="email" name="email" placeholder="Email"><br>
                    <input type="password" name="password" placeholder="Password"><br>
                    <input type="submit" name="login" value="LOGIN">
                
                </div>
            </div>
            
        </main>
    </div>
    
<?php require_once '/inc/footer.html' ?>