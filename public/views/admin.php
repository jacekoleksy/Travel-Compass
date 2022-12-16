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
        <table cellspacing="0">
            <tr>
                <th>ID_Country</th>
                <th>Name</th>
                <th>Price per month</th>
                <th>Price rent per month</th>
                <th>Temperature</th>
                <th>Data price per month</th>
            </tr>
            <?php if(isset($countries)){ 
                foreach ($countries as $country) { ?>
                    <tr>
                        <td><?php echo $country['id_country'] ?></td>
                        <td><?php echo $country['name'] ?></td>
                        <?php if(isset($current_country) && $current_country == $country['short']) { ?>
                            <?php
                                $url = "https://www.numbeo.com/cost-of-living/country_result.jsp?country=".$country['short']."&displayCurrency=USD";
                                $result = file_get_contents($url);
                                if($country['name'] == 'United States') {
                                    preg_match('#A single person estimated monthly costs are <span class="emp_number">.*?<span class="in_other_currency">\(.*?&\#36;\)<\/span><\/span> without rent\.<\/li><li>Cost#', $result, $price);
                                    $p1 = str_replace(array('A single person estimated monthly costs are <span class="emp_number">','<span class="in_other_currency">(','&#36;)</span></span> without rent.</li><li>Cost',','), "", $price[0]);
                                    $p1 = substr($p1, -7);
                                }
                                else {
                                    preg_match('#A single person estimated monthly costs are <span class="emp_number">.*?<span#', $result, $price);
                                    $p1 = str_replace(array('A single person estimated monthly costs are <span class="emp_number">','<span',',','&#36;'), "", $price[0]);
                                }
                                preg_match('#Apartment \(1 bedroom\) in City Centre </td> <td style="text-align: right" class="priceValue "> <span class="first_currency">.*?&nbsp;&\#36;#', $result, $pricerent);
                                $p2 = str_replace(array('Apartment (1 bedroom) in City Centre </td> <td style="text-align: right" class="priceValue "> <span class="first_currency">','&nbsp;&#36;',','), "", $pricerent[0]);
                                echo "<form method='POST'><td>D: ".$country['price']." <input name='price' type=number value=".($p1)."></input></td>"; 
                                echo "<td>D: ".$country['price_rent']." <input name='price2' type=number value=".($p2)."></input></td>";
                                echo "<td>D: ".$country['temperature']." <input name='temperature' type=number value=".($country['temperature'])."></input></td>";
                                echo "<td><button name='insert' type=submit value=".$country['id_country'].">Update</button></td></form>"; ?>
                            <?php } else { ?>
                                <td><?php echo $country['price'] ?></td>
                                <td><?php echo $country['price_rent'] ?></td>
                                <td><?php echo $country['temperature'] ?></td>
                                <td><form method="POST"><button name='short' type=submit value=<?php echo $country['short'] ?>>Download and edit data</button></form></td>
                        <?php } ?>
                    </tr>
            <?php }} else { ?>
                <tr>
                    <td><?php echo $error[0] ?></td>
                    <td><?php echo $error[1] ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php include_once('footer.php'); ?>
    <script type="text/javascript" src="public/js/index.js"></script> 
</body>

