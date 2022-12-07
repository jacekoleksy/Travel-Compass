<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/nav.css">
    <link rel="stylesheet" type="text/css" href="public/css/index.css">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Log in/Sign in</title>
</head>

<body>
    <div class="intro">
        <!-- <video autoplay muted loop id="movie">
            <source src="public/img/background1.mov" type="video/mp4" preload metadata>
        </video>
        <div id="video">
        </div> -->
        <div class="background">
            <img src="public/img/1 (9).jpg">
        </div>
        <?php include_once('nav.php'); ?>
        <div class="logo">
            <div class="logo_image">
                <img src="public/img/logo_new.png">
            </div>
            <div class="logo_text">
                <h1 class="random1"><span class="random_1">Find.</span></h1>
                <h1 class="random2"><span class="random_2">Visit.</span></h1>
                <h1 class="random3"><span class="random_3"></span></h1>
            </div>
        </div>
    </div>
    <div class="login-container">
        <form class="login" action="/settings_action" method="POST">
            <h1>Your account</h1>
                <div class="messages">
                    <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <div>
                <ul>
                    <li>
                        <h3>First Name *</h3>
                        <input id="settings-name" name="settings-name" type="text" value=<?php echo $_SESSION['name']?> placeholder="Name" readonly onfocus="this.removeAttribute('readonly');">
                    </li>
                    <li>
                        <h3>Last name *</h3>
                        <input id="settings-surname" name="settings-surname" type="text" value=<?php echo $_SESSION['surname']?> placeholder="Surname" readonly onfocus="this.removeAttribute('readonly');">
                    </li>
                    <li>
                        <h3>Login *</h3>
                        <input id="settings-email" name="settings-email" type="email" value=<?php echo $_SESSION['user']?> pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z0-9]{2,10}$" title="Email should only contain lower case letters, @ and . sign. Example: 'admin@gmail.com'" placeholder="E-mail" readonly onfocus="this.removeAttribute('readonly');">
                    </li>
                </ul>
                <ul>
                    <h2>Password</h2>
                    <li>
                        <h3>Current Password *</h3>
                        <input name="settings-password" type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$" title="Password must contain lower and upper case letters, at least one sign and number" placeholder="*******" readonly onfocus="this.removeAttribute('readonly');">
                    </li>
                    <li>
                        <h3>New Password</h3>
                        <input name="settings-new-password" type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$" title="Password must contain lower and upper case letters, at least one sign and number" placeholder="*******" readonly onfocus="this.removeAttribute('readonly');">
                    </li>
                </ul>
                </div>
                <button type="submit" value="settings">Update</button>
        </form>
    </div>
    <div class="container">
    <?php include_once('footer.php'); ?>
    <script type="text/javascript" src="public/js/index.js"></script> 
</body>