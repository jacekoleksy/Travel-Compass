<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/nav.css">
    <link rel="stylesheet" type="text/css" href="public/css/compass.css"> 
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
            <img src="public/img/1 (20).jpg">
        </div>
        <?php include_once('nav.php'); ?>
    </div>
    <div class="container">
        <div class="form">
            <h1>Standard Form</h1>
            <form class="compass" method="POST">
                <h2>Question <span class='current_question'><?php echo $currentquestion;?></span> of <?php echo $questionnum;?></h2>
                <p class="current_title"><?php echo $questiontitle ?></p>
                <div class="buttons">
                    <button type="button" value=-2 name="opinion">Strongly Disagree</button>
                    <button type="button" value=-1 name="opinion">Disagree</button>
                    <button type="button" value=0 name="opinion">No Opinion</button>
                    <button type="button" value=1 name="opinion">Agree</button>
                    <button type="button" value=2 name="opinion">Strongly Agree</button>
                </div>
                <div class="range">
                    <label>1000zł</label>
                    <input type="range" class="styled-slider slider-progress range1" name="range" min=1000 max=5500 oninput="setBubble(this, document.getElementsByClassName('output')[0])"></input>
                    <label>5500zł</label>
                    <output class="output"></output>
                    <script type="text/javascript" src="public/js/slider.js"></script> 
                </div>
                <div class="checkboxes">
                    <h2>Checkboxes</h2>
                </div>
                <input type="hidden" name='answers'></input>
                <button class="prev" type="button" name="prev" style="display:none">Previous</button>
                <a href="/compass"><button class="reset" type="button" name="reset">Reset</button></a>
            </form>
        </div>
    <?php include_once('footer.php'); ?>
    <script type="text/javascript" src="public/js/compass.js"></script> 
</body>
<?php
if ($questiontype == "buttons") {
?>
<style>
    .buttons {
        display: block;
    }
</style>
<?php
} else if ($questiontype == "range") {
?>
<style>
    .range {
        display: block;
    }
</style>
<?php
} else if ($questiontype == "checkboxes") {
?>
<style>
    .checkboxes {
        display: block;
    }
</style>
<?php
}
?>