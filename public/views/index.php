<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/nav.css">
    <link rel="stylesheet" type="text/css" href="public/css/index.css"> 
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <title>Travell Compass</title>
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
    <div class="container">
        <h2>Explore the World<!--- with us <span>🤍</span>/* ---></h2>
        <p>Are you looking for the <span>perfect vacation destination</span> and don't want to browse through <span>thousands of videos</span> and articles?</p>
        <p><span>That's what we're here for!</span></p>
        <p>Just answer few questions, and we will make sure that these one or two minutes will give you <span>days of unforgettable experiences.</span></p>
        <div id="choice">
            <div id="choice_1" onclick="location.href='/fastform';">
                <div></div>
                <!-- <img src="public/img/1 (12).jpg"> -->
                <h3>Fast</h3><p>Based on temperature and prices</p>
            </div>
            <div id="choice_2"onclick="location.href='/standardform';">
                <div></div>
                <!-- <img src="public/img/1 (16).jpg"> -->
                <h3>Standard</h3><p>Based on 10 questions</p>
            </div>
            <div id="choice_3"onclick="location.href='/accurateform';">
                <div></div>
                <!-- <img src="public/img/1 (14).jpg"> -->
                <h3>Accurate</h3><p>Based on 26 questions</p>
            </div>
        </div>
    <?php include_once('footer.php'); ?>
    <script type="text/javascript" src="public/js/index.js"></script> 
</body>