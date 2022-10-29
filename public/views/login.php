<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>Travel Compass</title>
</head>

<body>
    <h1>Hello</h1>
    <div class="login-container">
    <form class="login" action="/login" method="POST">
        <h1>Login</h1>
            <div class="messages">
                <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                ?>
            </div>
            <input name="login-email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z0-9]{2,10}$" title="Email should only contain lower case letters, @ and . sign. Example: 'admin@gmail.com'" placeholder="E-mail" readonly onfocus="this.removeAttribute('readonly');">
            <input name="login-password" type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$" title="Password must contain lower and upper case letters, at least one sign and number" placeholder="Password" readonly onfocus="this.removeAttribute('readonly');">
            <button type="submit" value="login">Log in</button>
        </form>
        <hr>
        <form class="login" action="/register" method="POST">
        <h1>Register</h1>
            <div class="messages">
                <?php
                    if(isset($messages2)){
                        foreach($messages2 as $message) {
                            echo $message;
                        }
                    }
                ?>
            </div>
            <div class="input-short">
                <input name="register-name" type="text" placeholder="Name" readonly onfocus="this.removeAttribute('readonly');">
                <input name="register-surname" type="text" placeholder="Surname" readonly onfocus="this.removeAttribute('readonly');">
            </div>
            <input name="register-email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z0-9]{2,10}$" title="Email should only contain lower case letters, @ and . sign. Example: 'admin@gmail.com'" placeholder="E-mail" readonly onfocus="this.removeAttribute('readonly');">
            <input name="register-password" type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" title="Password must contain lower and upper case letters, at least one sign and number" placeholder="Password" readonly onfocus="this.removeAttribute('readonly');">
            <input name="register-confirm-password" type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" title="Password must contain lower and upper case letters, at least one sign and number" placeholder="Confirm Password" readonly onfocus="this.removeAttribute('readonly');">
            <div class="terms">
                <input type="checkbox" name="terms-of-use">
                <h2>I accept <a href="public/files/Terms.pdf">Terms of Use</a></h2>
            </div>
            <button type="submit" name="register">Sign in</button>
        </form>
    </div>
</body>