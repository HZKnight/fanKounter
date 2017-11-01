<?php /* ver.inc.php
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
    faqs.txt - le risposte alle domande pi� comuni, sui problemi e sulle funzionalit�
 history.txt - la progressione delle versioni, i miglioramenti apportati e i bugs eliminati

 Descrizione del file
############################################################################################
 Modulo importato per la compatibilit� con PHP versione 4.2.0 e superiori.

      */

############################################################################################
# FUNZIONI GLOBALI
############################################################################################

// PHP >= 4.2.0
if(!function_exists("array_fill")){
 function array_fill($__init,$__len,$__value){
  settype($__init,"integer");
  settype($__len,"integer");

  $__array=array();

  for($__count=$__init;$__count<$__init+$__len;$__count++)
   $__array[$__count]=$__value;

  return $__array;
 }
}

// PHP >= 4.3.0

if(!function_exists("file_get_contents")){
 function file_get_contents($__name,$__unused=0){
  settype($__name,"string");

  return implode("",(file_exists($__name))?file($__name):array());
 }
}

// Riscrittura di 'array_slice()' che mantiene le associazioni con indici numerici

function _array_slice_($__array,$__offset,$__length=FALSE){
 settype($__array,"array");
 settype($__offset,"integer");
 settype($__length,($__length===FALSE)?"boolean":"integer");

 for($__end=($__offset>=0)?$__offset:count($__array)+$__offset,$__count=0;$__count<$__end;$__count++){
  reset($__array);
  unset($__array[key($__array)]);
 }

 if($__length!==FALSE)
  for($__end=($__length>=0)?count($__array)-$__length:abs($__length),$__count=0;$__count<$__end;$__count++){
   end($__array);
   unset($__array[key($__array)]);
  }

 return $__array;
}
############################################################################################

?>