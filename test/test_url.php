<?php
    include "../src/dic.inc.php";
    include "../src/url.inc.php";

    $url = "https://www.google.com/search?q=h0model&sxsrf=ACYBGNTox5WuEQywaX94AlUmon346uD5Yw:1577393984018&source=lnms&tbm=isch&sa=X&ved=2ahUKEwix-dnAmtTmAhVF-qQKHdlkBOAQ_AUoAnoECAsQBA&biw=1920&bih=983";
    $out = new Referrer($url);

    echo var_dump($out);