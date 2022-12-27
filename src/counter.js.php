<?php 
/* 
 * counter.js.php
 *                                       __       HZKnight free PHP Scripts    _    vs 5.1
 *                                      / _| __ _ _ __   /\ /\___  _   _ _ __ | |_ ___ _ __
 *                                     | |_ / _` | '_ \ / //_/ _ \| | | | '_ \| __/ _ \ '__|
 *                                     |  _| (_| | | | / __ \ (_) | |_| | | | | ||  __/ |
 *                                     |_|  \__,_|_| |_\/  \/\___/ \__,_|_| |_|\__\___|_|
 *
 *                                           lucliscio <lucliscio@h0model.org>, ITALY
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
 * Copyright (C)2022 HZKnight
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
 * Modulo che genera codice JavaScript da includere nelle pagine WEB da monitorare.
 * 
 *  @author  lucliscio <lucliscio@h0model.org>
 *  @version v 5.1
 *  @copyright Copyright 2022 HZKnight
 *  @copyright Copyright 2003 Fanatiko 
 *  @license http://www.gnu.org/licenses/agpl-3.0.html GNU/AGPL3
 *   
 *  @package fanKounter
 *  @filesource
 */

############################################################################################
# CONFIGURAZIONE
############################################################################################

//define("SCRIPT_PATH","http://www.domain.com/path/");

############################################################################################
# IMPOSTAZIONI DI ESECUZIONE
############################################################################################

error_reporting(0);
//import_request_variables("gpc","par__");
$__inputs = array_merge($_COOKIE,$_REQUEST); 
extract($__inputs, EXTR_PREFIX_ALL | EXTR_REFS, 'par_');

############################################################################################
# PARAMETRI IN INPUT
############################################################################################

$par__id=(isset($par__id)&&preg_match("/^[a-z\d]+$/i",$par__id))?$par__id:FALSE;
$par__mode=(isset($par__mode)&&preg_match("/^(graphic|text|hidden)$/i",$par__mode))?strtolower($par__mode):"graphic";
$par__mode=(($par__mode==="graphic")&&(!extension_loaded("gd")))?"text":$par__mode;

############################################################################################
# DEFINIZIONE DELLE VARIABILI DI SUPPORTO
############################################################################################

if(defined("SCRIPT_PATH"))
    $aux__script_path=SCRIPT_PATH;
elseif(array_key_exists("HTTP_HOST",$_SERVER)&&array_key_exists("SERVER_PORT",$_SERVER)&&array_key_exists("PHP_SELF",$_SERVER))
    $aux__script_path=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER["SERVER_NAME"].((($_SERVER["SERVER_PORT"]==="80") || ($_SERVER["SERVER_PORT"]==="443"))?"":(":".$_SERVER["SERVER_PORT"])).preg_replace("/".preg_quote(basename($_SERVER["PHP_SELF"]),"/")."$/","",$_SERVER["PHP_SELF"]);
else
    $aux__script_path=FALSE;

$aux__counter_href=$aux__script_path."counter.php"."?id=".$par__id."&mode=".$par__mode."&brname='+platform.name+'&brver='+platform.version+'&os='+platform.os.family+'&osver='+platform.os.version+'&referrer='+escape(_referrer)+'";
$aux__stats_href=$aux__script_path."stats.php"."?id=".$par__id;
$aux__jscode=($par__mode==="graphic")?("<a href=\'".$aux__stats_href."\'><img src=\'".$aux__counter_href."\' width=\'98\' height=\'38\' alt=\'fanKounter\' style=\'border:0px;\' /></a>"):("<script type=\'text/javascript\' language=\'javascript\' src=\'".$aux__counter_href."\'></script>");
$aux__jslib = $aux__script_path."libs/js/platform.js";

############################################################################################
# GENERAZIONE DI CODICE JAVASCRIPT
############################################################################################

$__jsfile=<<<JSFILE
/* This file was created by fanKounter */

try
{
 var _referrer=top.document.referrer; 
}
catch(_err)
{
 var _referrer=self.document.referrer;
}

console.log(platform);

document.write('$aux__jscode');
JSFILE;

############################################################################################
# OUTPUT
############################################################################################

header("Content-type: text/javascript");

require_once ('libs/js/platform.js');

echo $__jsfile;
exit();

############################################################################################

?>