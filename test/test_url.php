<?php
    include "../src/dic.inc.php";
    include "../src/url.inc.php";

    $url = "https://it.search.yahoo.com/search?p=h0model&fr=yfp-t&fp=1&toggle=1&cop=mss&ei=UTF-8";
    $out = new Referrer($url);

    echo "Server: ".$_SERVER['SERVER_SOFTWARE']."<br/><br/><pre>";
    echo var_dump($out);
    echo "</pre>";