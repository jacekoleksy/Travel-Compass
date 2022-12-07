<h2>Results<!--- with us <span>🤍</span>/* ---></h2>
        <p>Here you can find all of <span>our possible results,</span> or outcomes related to your previous form completion.</p>
        <div class="result">
            <div id="result_1" onclick="location.href='/recommended';">
                <div></div>
                <!-- <img src="public/img/1 (12).jpg"> -->
                <h3>Our Results</h3><p>All of the possible outcomes</p>
                <p><span>Our results</span> are based on the opinion of <span>experts</span> and (importantly) <span>thousands of tourists.</span> Price and temperature data is also <span>updated daily,</span> ensuring that the results are always accurate.
                <br><br>Browse through the suggestions to check them all out and get inspired if you're not satisfied with the results.</p>
            </div>
            <div id="result_2" onclick="location.href='/results';">
                <div></div>
                <!-- <img src="public/img/1 (16).jpg"> -->
                <h3>Your Results</h3><p>After the holidays, check if our results were correct</p>
                <p>Here you will find your previous <span>data-based results</span> if you have created an account. If they are not suitable, <span>you can rate them</span> and we will try to improve the search results for you in the future.
                <br><br>Don't hesitate to ask if something is unclear. Just write an email to <span><a href="mailto:info@travellcompass.com">info@travellcompass.com</a></span></p>
            </div>
        </div>
        <div class="description">
            <p><span>Our results</span> are based on the opinion of <span>experts</span> and (importantly) <span>thousands of tourists.</span> Price and temperature data is also <span>updated daily,</span> ensuring that the results are always accurate.
            <br><br>Browse through the suggestions to check them all out and get inspired if you're not satisfied with the results.</p>
            <p>Here you will find your previous <span>data-based results</span> if you have created an account. If they are not suitable, <span>you can rate them</span> and we will try to improve the search results for you in the future.
            <br><br>Don't hesitate to ask if something is unclear. Just write an email to <span><a href="mailto:info@travellcompass.com">info@travellcompass.com</a></span></p>
        </div>
        <!-- <div class="footer_background">
            <img src="public/img/1 (21).jpg">
        </div> -->
    </div>
<div class="footer">
    <p>&copy; Travell Compass, Jacek Oleksy PK. All rights reserved.</p>
    <p id="break">|</p>
    <a href="/about_us"><p>ABOUT</p></a>
    <a href="/compass"><p>RESULTS</p></a>
    <a href="/recommended"><p>DESTINATIONS</p></a>
    <?php if (!isset($_SESSION['user'])) { ?>
        <a href="/login"><p>SIGN IN</p></a>
    <?php } else { ?>
        <a href="/settings"><p>SETTINGS</p></a>
        <a href="/logout"><p>LOG OUT</p></a>
    <?php } ?>
</div>