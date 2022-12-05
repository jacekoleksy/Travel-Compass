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
            <h1><?php echo $formtype;?> Form</h1>
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
                    <label id="minlabel"><?php echo $value_w ?>$</label>
                    <input type="range" class="styled-slider slider-progress range1" name="range" min=<?php echo $value_w ?> max=<?php echo $value_h ?> value=<?php echo (($value_w+$value_h)/2) ?> oninput="setBubble(this, document.getElementsByClassName('output')[0])"></input>
                    <label id="maxlabel"><?php echo $value_h ?>$</label>
                    <output class="output"></output>
                    <script type="text/javascript" src="public/js/slider.js"></script> 
                </div>
                <div class="range2">
                    <label id="minlabel"><?php echo $value_w2 ?>°C</label>
                    <input type="range" class="styled-slider slider-progress range1" name="range" min=<?php echo $value_w2 ?> max=<?php echo $value_h2 ?> value=<?php echo (($value_w2+$value_h2)/2) ?> oninput="setBubble(this, document.getElementsByClassName('output')[0])"></input>
                    <label id="maxlabel"><?php echo $value_h2 ?>°C</label>
                    <output class="output"></output>
                    <script type="text/javascript" src="public/js/slider.js"></script> 
                </div>
                <div class="checkboxes">
                    <button type="button" value=1 name="opinion"><?php echo $resultstype[0]['results_type'] ?></button>
                    <button type="button" value=2 name="opinion"><?php echo $resultstype[1]['results_type'] ?></button>
                    <button type="button" value=3 name="opinion"><?php echo $resultstype[2]['results_type'] ?></button>
                </div>
                <input type="hidden" name='answers'></input>
                <button class="prev" type="button" name="prev" style="display:none" value=1>Previous</button>
                <a href="/compass"><button class="reset" type="button" name="reset">Reset</button></a>
                <button class="next" type="button" name="next" value=1>Next</button>
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