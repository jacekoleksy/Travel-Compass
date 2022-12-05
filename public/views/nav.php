<div class="nav">
    <!-- <div>
        <img id="logo" src="public/img/logo_mini.png">
    </div> -->
    <a href="index"><img id="logo" src="public/img/logo_mini.png"><p>Compass</p></a>
    <div class="nav-rest">
        <a href="/about_us"><p>About&nbsp;Us</p></a>
        <a href="/results"><p>Results</p></a>
        <a href="/recommended"><p>Destinations</p></a>
    </div>
    <?php if (!isset($_SESSION['user'])) { ?>
        <a href="/login" id="nav-login"><p>Sign&nbsp;In</p><img id="user" src="public/img/user.png"></a>
    <?php } else { ?>
        <a href="/logout" id="nav-login"><p>Log&nbsp;Out</p></a><a href='/settings'><img id="user" src="public/img/user.png"></a>
    <?php } ?>
    <script type="text/javascript" src="public/js/nav.js"></script> 
</div>