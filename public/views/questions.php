<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/nav.css">
    <link rel="stylesheet" type="text/css" href="public/css/questions.css"> 
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script type="text/javascript" src="public/js/questions.js"></script> 
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
            <img src="public/img/1 (20).jpg">
        </div>
        <?php include_once('nav.php'); ?>
    </div>
    <div class="container">
        <div class="form">
            <h1>Standard Form</h1>
            <form class="compass" method="post">
                <h2>Question 1/10</h2>
                <p>What are the advantages and disadvantages of traveling alone?</p>
                <div class="buttons">
                    <!-- <button type="button" value=-2 name="opinion">Strongly Disagree</button>
                    <button type="button" value=-1 name="opinion">Disagree</button>
                    <button type="button" value=0 name="opinion">No Opinion</button>
                    <button type="button" value=1 name="opinion">Agree</button>
                    <button type="button" value=2 name="opinion">Strongly Agree</button> -->
                </div>
                <div class="range">
                    <label>1000zł</label>
                    <input type="range" class="styled-slider slider-progress" name="range" min=1000 max=5500 oninput="setBubble(this, document.getElementsByClassName('output')[0])"></input>
                    <label>5500zł</label>
                    <output class="output"></output>
                    <script type="text/javascript" src="public/js/slider.js"></script> 
                </div>
            </form>
        </div>
    <?php include_once('footer.php'); ?>
</body>