<?php
    include "../src/dic.inc.php";
    include "../src/url.inc.php";

    $url = "https://www.google.ch/";
    $out = new Referrer($url);

    echo "Server: ".$_SERVER['SERVER_SOFTWARE']."<br/><br/><pre>";
    echo var_dump($out);
    echo "</pre>";