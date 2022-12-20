<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/nav.css">
    <link rel="stylesheet" type="text/css" href="public/css/index.css"> 
    <link rel="stylesheet" type="text/css" href="public/css/admin.css"> 
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
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
        <?php if(isset($countries)){ ?>
            <form method="POST">
                <select id="country" name='country'>
                    <?php foreach ($countries as $country) { ?>
                        <option value=<?php echo $country['id_results'] ?>><?php echo $country['name']." (".$country['id_results'].")" ?></option>
                    <?php } ?>
                </select>
                <button name='temperature' type='submit'>Get temperatures</button>
            </form>
                <?php if(isset($temperatures)){ ?>
                     <form method="POST">
                        <table id="temp">
                            <tr>
                                <th>ID Country</th>
                                <th>Country</th>
                                <th>January</th>
                                <th>February</th>
                                <th>March</th>
                                <th>April</th>
                                <th>May</th>
                                <th>June</th>
                                <th>July</th>
                                <th>August</th>
                                <th>September</th>
                                <th>October</th>
                                <th>November</th>
                                <th>December</th>
                            </tr>
                            <tr>
                                <td><?php echo $temperatures[0]['id_results'] ?><input type='hidden' name='id_results' value=<?php echo $temperatures[0]['id_results'] ?>></td>
                                <td><?php echo $temperatures[0]['name'] ?></td>
                                <?php $url = "https://www.weatherbase.com/weather/weather.php3?s=".$temperatures[0]['temperature_link']."&units=metric";
                                    $result = file_get_contents($url);
                                        preg_match('#<tr bgcolor="white"><td align=right class=dataunit>C<\/td><td class=data>.*?<\/td><td class=data>.*?<\/td><td class=data>.*?<\/td><td class=data>.*?<\/td><td class=data>.*?<\/td><td class=data>.*?<\/td><td class=data>.*?<\/td><td class=data>.*?<\/td><td class=data>.*?<\/td><td class=data>.*?<\/td><td class=data>.*?<\/td><td class=data>.*?<\/td><td class=data>.*?<\/td>#', 
                                        $result, $price);
                                        $p1 = str_replace(array('<tr bgcolor="white"><td align=right class=dataunit>C</td><td class=data>', '/td>', '<td class=data'), "", $price[0]); 
                                        $p1 = str_replace(array('<>', '>', '<'), "|", $p1); 
                                        $pieces = explode("|", $p1);
                                foreach ($temperatures as $key => $temperature) { 
                                        echo "<td><div class='cell'>".$temperatures[$key]['temp']."<input type='number' step=any name=".($key+1)." value=".$pieces[$key+1]."></input></div></td>"; 
                                    // echo "<td><input type='number' name=".$temperature['month']." value=".$temperature['temperature']."></input></td>"; 
                                } ?>
                            </tr>
                        </table>
                        <button name='temperatures' type='submit' >Set temperatures</button>
                    </form>
                <?php } ?>
        <?php } else { ?>
                <h1><?php echo $error[0] ?></h1>
                <h1><?php echo $error[1] ?></h1>
        <?php } ?>

    <?php include_once('footer.php'); ?>
    <script type="text/javascript" src="public/js/index.js"></script> 
    <script type="text/javascript" src="public/js/admin.js"></script> 
</body>

