<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/nav.css">
    <link rel="stylesheet" type="text/css" href="public/css/results.css"> 
    <link rel="stylesheet" type="text/css" href="public/css/recommended.css"> 
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://kit.fontawesome.com/d4ded950a9.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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
            <?php if(isset($recommended)){
                $count = 0;
                foreach ($recommended as $recommend) {
                    if ($count == 0) { ?>
                        <img id="active-bcg" src=<?php echo "public/img/results/".$recommend['id'].".jpg" ?>>
                    <?php } else { ?>
                        <img id="not-active" src=<?php echo "public/img/results/".$recommend['id'].".jpg" ?>>
                <?php } $count += 1; }} else { ?>
                <img src="public/img/1 (23).jpg">
            <?php } ?>
        </div>
        <?php include_once('nav.php'); ?>
        <div class="button-next"> 
            <button type="button" name="next" id="next" onclick="nextResult()"><img src="public/img/next.png"></img></button>
        </div>
    </div>
    <div class="your-result">
        <?php if(isset($recommended)){
                $count = 0;
                foreach ($recommended as $recommend) {
                    if ($count == 0) { ?>
                        <div class="data" id='active'>
                        <?php } else { ?>
                        <div class="data">
                        <?php } ?>
                            <div class="temperature">
                                <h3><?php echo intval($recommend['temperature']) ?>°C</h3>
                                <img src="public/img/sun_black.png">
                            </div>
                            <h1><?php echo strtoupper($recommend['name']) ?></h1>
                            <h1><?php echo strtoupper($recommend['country']) ?></h1>
                            <p><?php echo $recommend['description'] ?></p>
                            <a href="#active-map"><button type="button" name="data">PLAN YOUR TRIP</button></a>
                        </div>
                        <?php $count += 1; }} else { ?>
                        <div class="data" id='active'>
                            <h1><?php echo $error[0] ?></h1>
                            <h1><?php echo $error[1] ?></h1>
                        </div>
                        <?php } ?>
    </div>
    <?php if(isset($recommended)){ 
        $count = 0;
        foreach ($recommended as $recommend) { ?>
            <?php if ($count == 0) { ?>
                    <div class="results-map" id="active-map">
                <?php } else { ?>
                    <div class="results-map" id="results-map">
                <?php } ?>    
                    <iframe style="filter: invert(90%)" src=<?php echo $recommend['map'] ?> style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div class="results-details">
                        <table>
                            <tr>
                                <td colspan="3" id="title">
                                    <h1>Result data:</h1>
                                </td>
                            </tr>
                            <tr>  
                                <td><h1>Activity factor:</h1></td>
                                <td><input type="range" class="styled-slider slider-progress range1" name="range" min=-10 max=10 value=<?php echo $recommend['value_w'] ?>></input></td>
                            </tr>
                            <tr>  
                                <td><h1>Result temperature:</h1></td>
                                <td class="table-data"><h1 id="temperature"><?php echo $recommend['temperature'] ?></h1></td>
                            </tr>
                            <tr>  
                                <td><h1>Result price:</h1></td>
                                <td class="table-data"><h1 id="price"><?php echo $recommend['price'] ?></h1></td>
                            </tr>
                        </table>
                        <p>
                            Remember that our data is based on users experience, experts opinion and it's not always 100% reliable. At the end everything depends on you and your decisions.&nbsp;
                            Your place of living and transportation price is also very important, and it can influence the final price of your vacation.
                        </p>
                    </div>
                </div>
            <?php $count += 1; }} else { ?>
                <div class="results-map" id="active-map">
                    <iframe style="filter: invert(90%)" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d23747775.914912067!2d27.652760064111348!3d43.400052381403775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2spl!4v1670270340398!5m2!1sen!2spl" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <div class="results-details" id='active'>
                        <h1><?php echo $error[0] ?></h1>
                        <h1><?php echo $error[1] ?></h1>
                    </div>
                </div>
        <?php } ?>
    <div class="container"> 
    <?php include_once('footer.php'); ?>
    <script type="text/javascript" src="public/js/results.js"></script> 
    <script type="text/javascript" src="public/js/slider.js"></script> 
</body>