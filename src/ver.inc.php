<?php 
/* 
 * ver.inc.php
 *                                       __                      PHP Script    _    vs 5.0
 *                                      / _| __ _ _ __   /\ /\___  _   _ _ __ | |_ ___ _ __
 *                                     | |_ / _` | '_ \ / //_/ _ \| | | | '_ \| __/ _ \ '__|
 *                                     |  _| (_| | | | / __ \ (_) | |_| | | | | ||  __/ |
 *                                     |_|  \__,_|_| |_\/  \/\___/ \__,_|_| |_|\__\___|_|
 *
 *                                             lucliscio <lucliscio@h0model.org>, ITALY
 *
 * -------------------------------------------------------------------------------------------
 * Documentazione di riferimento
 * -------------------------------------------------------------------------------------------
 * license.txt - le condizioni di utilizzo, modifica e redistribuzione per l'utente finale
 *  manual.txt - la guida alla configurazione, all'installazione e all'uso dello script
 *    faqs.txt - le risposte alle domande più comuni, sui problemi e sulle funzionalità
 * history.txt - la progressione delle versioni, i miglioramenti apportati e i bugs eliminati
 *
 * -------------------------------------------------------------------------------------------
 * Licence
 * -------------------------------------------------------------------------------------------
 * Copyright (C) 2017 Luca Liscio
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/agpl-3.0.html>.
 */

/**
 * Modulo importato per la compatibilità con PHP versione 4.2.0 e superiori.
 * 
 *  @author  lucliscio <lucliscio@h0model.org>
 *  @version v 5.0
 *  @copyright Copyright 2017 Luca Liscio
 *  @copyright Copyright 2003 Fanatiko 
 *  @license http://www.gnu.org/licenses/agpl-3.0.html GNU/AGPL3
 *   
 *  @package fanKounter
 *  @filesource
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