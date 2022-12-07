<div class="nav">
    <!-- <div>
        <img id="logo" src="public/img/logo_mini.png">
    </div> -->
    <a href="compass"><img id="logo" src="public/img/logo_mini.png"></a><a href="index"><p>Compass</p></a>
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
<div class="nav-mobile">
    <div id="bars">
        <img id="logo" src="public/img/bars_mobile.png">
    </div>
    <div id="user">
    <?php if (!isset($_SESSION['user'])) { ?>
        <a href="/login"><img id="logo" src="public/img/user.png"></a>
    <?php } else { ?>
        <a href="/settings"><img id="logo" src="public/img/user.png"></a>
    <?php } ?>
    </div>
    <div id="menu-bars">
        <a href="/compass"><p>Compass</p></a>
        <a href="/index"><p>About&nbsp;Us</p></a>
        <a href="/results"><p>Results</p></a>
        <a href="/recommended"><p>Destinations</p></a>
        <?php if (isset($_SESSION['user'])) { ?>
            <a href="/logout"><p>Log&nbsp;Out</p></a>
        <?php } else { ?>
            <a href="/login"><p>Log&nbsp;In</p></a>
        <?php } ?>
    </div>
</div>
<script type="text/javascript" src="public/js/nav-mobile.js"></script> 