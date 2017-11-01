<?php /* out.inc.php
                                        __                      PHP Script    _    vs 5.0
                                       / _| __ _ _ __   /\ /\___  _   _ _ __ | |_ ___ _ __
                                      | |_ / _` | '_ \ / //_/ _ \| | | | '_ \| __/ _ \ '__|
                                      |  _| (_| | | | / __ \ (_) | |_| | | | | ||  __/ |
                                      |_|  \__,_|_| |_\/  \/\___/ \__,_|_| |_|\__\___|_|

                                              fanatiko <fankounter@libero.it>, ITALY
 Documentazione di riferimento
############################################################################################
 license.txt - le condizioni di utilizzo, modifica e redistribuzione per l'utente finale
  manual.txt - la guida alla configurazione, all'installazione e all'uso dello script
    faqs.txt - le risposte alle domande più comuni, sui problemi e sulle funzionalità
 history.txt - la progressione delle versioni, i miglioramenti apportati e i bugs eliminati

 Descrizione del file
############################################################################################
 Modulo importato per la stampa del contatore.

      */

############################################################################################
# BLOCCO ESECUZIONE STANDALONE
############################################################################################

if(!defined("STANDALONE"))
 exit();

############################################################################################
# CONTEGGIO DEGLI ACCESSI
############################################################################################

define("TOTAL_VAL",$dat__counter);
define("TODAY_VAL",$aux__calendar->_get_hits_($aux__now,"d"));

############################################################################################
# NESSUNA CACHE
############################################################################################

header("Expires: ".gmdate("D, d M Y H:i:s")." GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0",FALSE);
header("Pragma: no-cache");

############################################################################################
# CONTATORE GRAFICO
############################################################################################

if($par__mode==="graphic"){
 if(file_exists("lan.inc.php")){require_once("lan.inc.php");}
 if(!defined("LAN_TODAY"))define("LAN_TODAY","OGGI");
 if(!defined("LAN_TOTAL"))define("LAN_TOTAL","TOTALE");

 define("IMG_DATA","iVBORw0KGgoAAAANSUhEUgAAAGIAAAAmCAIAAACwDtkjAAAACXBIWXMAAA7DAAAOwwHHb6hkAAABOklEQVR4nO2Xyw2DMBBEOVAapaQSGkgJlBApx5SRdnJwDkSO490143j5CM3THjAfL3mMEen6YWQtVtcP4+3xZBXqqykQA0VTIXUu/eZCTn5NUyw53BJdk5W69mZzFzy5mRRHQVWrx9R0ud7Tms9rTBmeo0iqyTdEK2pqSVl6SRCrL5szXpWuOGtCOZRdrF7gnVRrakmZ9TOso8F+H+EzgDuto56awJRlSVEfo6opiJeUrybrTtJ2PprU/QVNVWmS2+5pKjzO3TTVLro4QxyuoekQacqyra7T7FD5uylbKbKLNW1hW96nqcnq9EeFs5Br2v3v5QFL0eQYpdOUoomoUBMENUFQEwQ1QVATBDVBUBMENUFQEwQ1QVATBDVBUBMENUFQEwQ1QVATBDVBUBMENUH8aGIV6qOJtVhvitqQTVHOp7kAAAAASUVORK5CYII=");
 define("TODAY_TXT_YX","4,17");
 define("TODAY_VAL_YX","39,14");
 define("TOTAL_TXT_YX","4,27");
 define("TOTAL_VAL_YX","39,24");
 define("TODAY_TXT_SIZE",1);
 define("TODAY_VAL_SIZE",3);
 define("TOTAL_TXT_SIZE",1);
 define("TOTAL_VAL_SIZE",3);
 define("TODAY_TXT_COLOR","0x14,0x14,0x50");
 define("TODAY_VAL_COLOR","0x3C,0x3C,0x50");
 define("TOTAL_TXT_COLOR","0x14,0x14,0x50");
 define("TOTAL_VAL_COLOR","0x3C,0x3C,0x50");

 $__img=imagecreatefromstring(base64_decode(IMG_DATA));

 eval("\$__col1=imagecolorallocate(\$__img,".TODAY_TXT_COLOR.");");
 eval("\$__col2=imagecolorallocate(\$__img,".TODAY_VAL_COLOR.");");
 eval("\$__col3=imagecolorallocate(\$__img,".TOTAL_TXT_COLOR.");");
 eval("\$__col4=imagecolorallocate(\$__img,".TOTAL_VAL_COLOR.");");

 $__txtpad=max(strlen(LAN_TODAY),strlen(LAN_TOTAL));

 eval("imagestring(\$__img,".TODAY_TXT_SIZE.",".TODAY_TXT_YX.",\"".str_pad(LAN_TODAY,$__txtpad," ",STR_PAD_LEFT)."\",\$__col1);");
 eval("imagestring(\$__img,".TODAY_VAL_SIZE.",".TODAY_VAL_YX.",\"".str_pad(TODAY_VAL,8," ",STR_PAD_LEFT)."\",\$__col2);");
 eval("imagestring(\$__img,".TOTAL_TXT_SIZE.",".TOTAL_TXT_YX.",\"".str_pad(LAN_TOTAL,$__txtpad," ",STR_PAD_LEFT)."\",\$__col3);");
 eval("imagestring(\$__img,".TOTAL_VAL_SIZE.",".TOTAL_VAL_YX.",\"".str_pad(TOTAL_VAL,8," ",STR_PAD_LEFT)."\",\$__col4);");

 header("Content-type: image/png");
 imagepng($__img);
 imagedestroy($__img);
 return;
}

############################################################################################
# CONTATORE TESTUALE/NASCOSTO
############################################################################################

header("Content-type: text/javascript");
echo"/* This file was created by fanKounter */".EOL;

if($par__mode==="text")
 echo"document.write('".TOTAL_VAL."');".EOL;

return;

############################################################################################

?>