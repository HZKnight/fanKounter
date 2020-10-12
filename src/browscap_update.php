<?php
    use phpbrowscap\Browscap;
    require_once 'libs/Browscap.php';
    
    ini_set('memory_limit', '-1');

    $browscap = new Browscap('temp/cache');
    $browscap->updateCache();
?>
