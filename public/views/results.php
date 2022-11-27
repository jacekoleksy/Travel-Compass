<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/nav.css">
    <link rel="stylesheet" type="text/css" href="public/css/results.css"> 
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://kit.fontawesome.com/d4ded950a9.js" crossorigin="anonymous"></script>
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
            <img src="public/img/1 (23).jpg">
        </div>
        <?php include_once('nav.php'); ?>
    </div>
    <div class="your-result">
        <?php if(isset($results)){
                $count = 0;
                foreach ($results as $result) {
                    if ($count == 0) { ?>
                        <div class="data" id='active'>
                        <?php } else { ?>
                        <div class="data">
                        <?php } ?>
                            <div class="temperature">
                                <h3><?php echo intval($result['temperature']) ?>°</h3>
                                <img src="public/img/sun_black.png">
                            </div>
                            <h1><?php echo $result['name'] ?></h1>
                            <h1><?php echo $result['country'] ?></h1>
                            <p><?php echo $result['description'] ?></p>
                        </div>
                        <?php $count += 1; }} else { ?>
                        <div class="data" id='active'>
                            <h1><?php echo $error[0] ?></h1>
                            <h1><?php echo $error[1] ?></h1>
                        </div>
                        <?php } ?>
    </div>
    <div class="container">
        <div class='no-results'><h1><?php echo $error[0] ?></h1>
        <h2><?php echo $error[1]?><a href='/compass'><?php echo $error[2]?></a></h2></div> 
    <?php include_once('footer.php'); ?>
    <script type="text/javascript" src="public/js/results.js"></script> 
</body>