<?php 
/* 
 * stats.php
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
 * Modulo per la visualizzazione dei dati statistici.
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
# INCLUSIONE DELLE LIBRERIE
############################################################################################

require("libs/rain.tpl.class.php");

############################################################################################
# INCLUSIONE DEI MODULI
############################################################################################

require("ver.inc.php");
require("sys.inc.php");
require("cnf.inc.php");
require("dic.inc.php");
require("cal.inc.php");
require("lan.inc.php");

############################################################################################
# INIZIALIZZAZIONE DELLE LIBRERIE
############################################################################################

RainTPL::$tpl_dir = "template/fanKounter_classic/";
RainTPL::$cache_dir = "temp/tpl/";
$view = new RainTPL();

############################################################################################
# PARAMETRI IN INPUT
############################################################################################

$par__id=(isset($par__id)&&preg_match("/^[a-z\d]+$/i",$par__id))?$par__id:FALSE;
$par__passwd=(isset($par__passwd)&&($par__passwd!==""))?$par__passwd:FALSE;
$par__panel=(isset($par__panel)&&preg_match("/^(0|1|2|3|4|5)+$/",$par__panel))?(int)$par__panel:0;

############################################################################################
# ACQUISIZIONE DELLA CONFIGURAZIONE DI UN CONTATORE
############################################################################################

if($par__id!==FALSE&&file_exists(CONFIG_FOLDER._filename_(CONFIG_FILES,$par__id))){
    require(CONFIG_FOLDER._filename_(CONFIG_FILES,$par__id));
}
else {
    $par__id=FALSE;
}

settype($cnf__userpass,"string");
settype($cnf__mtime_unique_accs,"integer");
settype($cnf__expire_on_midnight,"boolean");
settype($cnf__count_per_pages,"boolean");
settype($cnf__htime_sync_server,"integer");
settype($cnf__last_entries,"integer");
settype($cnf__passwd_protect,"boolean");
settype($cnf__limit_view,"integer");

############################################################################################
# STAMPA DEL MASCHERINO DI ACCESSO
############################################################################################

if(($par__id===FALSE)||($cnf__passwd_protect&&(md5($par__passwd)!==$cnf__userpass))){
    setcookie("passwd","");
    
    $view->assign("version", VERSION);
    $view->assign("homepage", HOMEPAGE);
    $view->assign("email", EMAIL);
    $view->assign("title", _strlan_(LAN_TITLE1,TRUE));
    $view->assign("charset", CHARSET);
    $view->assign("action", $_SERVER["PHP_SELF"]);
    $view->assign("contatore", _strlan_(LAN_MASK1,TRUE));
    
    $counters = array();
    settype($control,"integer");
    foreach(_ls_(CONFIG_FOLDER,CONFIG_FILES) as $__counter){
        if(preg_match("/^([a-z\d])+$/i",$__id=preg_replace("/^".preg_replace("/\\x5C\\x2A/","(.*)",preg_quote(CONFIG_FILES,"/"))."$/","\\1",$__counter))){
            $counters[$__id] = (($__id===$par__id)?" selected=\"selected\"":"");
        }           
    }
    
    $view->assign("counters", $counters);
    $view->assign("password", _strlan_(LAN_MASK2,TRUE));
    
    $view->draw("login");
    
    exit();
}
elseif($cnf__passwd_protect)
 setcookie("passwd",$par__passwd);
else
 setcookie("passwd","");

############################################################################################
# DEFINIZIONE DELLE VARIABILI DI SUPPORTO
############################################################################################

$aux__now=NOW+$cnf__htime_sync_server*3600;
$aux__calendar=new Calendar;
$dat__calendar=array();
$dat__entry=array();

############################################################################################
# ACCESSO ESCLUSIVO AI FILE DI DATI STATISTICI
############################################################################################

_flock_();

############################################################################################
# ALLINEAMENTO DEI DATI STATISTICI
############################################################################################

if(file_exists(BACKUP_FOLDER._filename_(DATA_FILES,$par__id))){
 _fcopy_(BACKUP_FOLDER._filename_(DATA_FILES,$par__id),DATA_FOLDER._filename_(DATA_FILES,$par__id));
 _fdel_(BACKUP_FOLDER._filename_(DATA_FILES,$par__id));
}

if(file_exists(DATA_FOLDER._filename_(DATA_FILES,$par__id))){
 require(DATA_FOLDER._filename_(DATA_FILES,$par__id));
}
else
 exit("'".$par__id."' counter not initialized.");

$aux__calendar->_update_($dat__calendar);

############################################################################################
# RILASCIO DELLE RISORSE ACQUISITE
############################################################################################

_funlock_();

############################################################################################
# OUTPUT
############################################################################################

echo"<!DOCTYPE html PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">";
echo EOL.EOL;
echo"<!-- fanKounter v".VERSION." - by fanatiko (Italy) //-->";
echo EOL;
echo"<!-- ".HOMEPAGE." //-->";
echo EOL;
echo"<!-- mailto:".EMAIL." //-->";
echo EOL.EOL;
echo"<html>";
echo"<head>";
echo"<title>"._strlan_(LAN_TITLE2,TRUE,$par__id)."</title>";
echo"<meta name=\"description\" content=\"fanKounter: uno script in PHP per creare e gestire contatori di visite con statistiche per pagine WEB.\" />";
echo"<meta name=\"keywords\" content=\"accessi,contatore,counter,fanKounter,pagine,PHP,script,statistiche,stats,reload,unici,visitatori,visite,WEB\" />";
echo"<meta http-equiv=\"content-type\" content=\"text/html; charset=".CHARSET."\" />";
echo"<base target=\"_top\" />";
echo"<link type=\"text/css\" rel=\"stylesheet\" href=\"stats.css\" />";
echo"<script type=\"text/javascript\" language=\"javascript\" src=\"".HOMEPAGE."/adnews.php?v=".VERSION."\"></script>";
echo"</head>";
echo"<body>";
echo"<div align=\"center\">";
echo"<table cellspacing=\"0\" cellpadding=\"0\" class=\"conteiner\">";
echo"<tr>";
echo"<td align=\"center\">";
echo"<table cellspacing=\"0\" cellpadding=\"0\">";
echo"<tr>";

foreach(array(_strlan_(LAN_MENU1,TRUE)=>0,_strlan_(LAN_MENU2,TRUE)=>1,_strlan_(LAN_MENU3,TRUE)=>2,_strlan_(LAN_MENU4,TRUE)=>3,_strlan_(LAN_MENU5,TRUE)=>4,_strlan_(LAN_MENU6,TRUE)=>5) as $__name=>$__panel){
 echo"<td valign=\"bottom\">";
 echo"<form method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\">";
 echo"<input type=\"hidden\" name=\"id\" value=\"".$par__id."\" />";
 echo"<input type=\"hidden\" name=\"panel\" value=\"".$__panel."\" />";
 echo ($par__panel===$__panel)?("<input type=\"submit\" value=\"".$__name."\" class=\"menu_hi\" />"):("<input type=\"submit\" value=\"".$__name."\" onmouseover=\"javascript:this.className=&quot;menu_up&quot;;\" onmouseout=\"javascript:this.className=&quot;menu&quot;;\" class=\"menu\" />");
 echo"</form>";
 echo"</td>";
}

echo"<td valign=\"bottom\">";
echo"<form method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\">";
echo"<input type=\"submit\" value=\""._strlan_(LAN_MENU7,TRUE)."\" onmouseover=\"javascript:this.className=&quot;menuq_up&quot;;\" onmouseout=\"javascript:this.className=&quot;menuq&quot;;\" class=\"menuq\" />";
echo"</form>";
echo"</td>";
echo"</tr>";
echo"</table>";
echo"</td>";
echo"</tr>";
echo"<tr>";
echo"<td class=\"conteiner\">";
echo"<p class=\"header\">"._strlan_(LAN_HEADER,FALSE,$par__id,_strdate_($aux__now,"d"),date("G:i",$aux__now),_strdate_($aux__now,"w"))."</p>";
eval("_panel".$par__panel."_();");
echo"<p class=\"top\"><a href=\"javascript:scroll(0,0);\">"._strlan_(LAN_TOP,TRUE)."</a></p>";
echo"</td>";
echo"</tr>";
echo"</table>";
echo"<p class=\"credits\">&copy2017 HZKnight | &copy;2002 fanatiko | <a href=\"".HOMEPAGE."/index.php\">fanKounter</a> a Free PHP Script</p>";
echo"</div>";
echo"</body>";
echo"</html>";
echo EOL.EOL;
exit();

############################################################################################
# PANNELLO DEL SOMMARIO
############################################################################################

function _panel0_(){
 global $par__id;
 global $cnf__mtime_unique_accs,$cnf__expire_on_midnight,$cnf__count_per_pages;
 global $dat__counter,$dat__started;
 global $aux__now,$aux__calendar;

 $__max4d=$aux__calendar->_max_hits_in_date_();
 $__max4m=$aux__calendar->_max_hits_in_month_();
 $__gd=(extension_loaded("gd"))?gd_info():FALSE;

 echo"<p class=\"title\">"._strlan_(LAN001)."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN002,FALSE,$aux__calendar->_get_hits_($aux__now,"d"))."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN003,FALSE,$aux__calendar->_get_hits_(_tsoffset_(-1,"d"),"d"))."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN004,FALSE,$aux__calendar->_get_hits_($aux__now,"m"))."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN005,FALSE,$aux__calendar->_get_hits_(_tsoffset_(-1,"m"),"m"))."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN006,FALSE,$aux__calendar->_get_hits_($aux__now,"y"))."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN007,FALSE,$aux__calendar->_get_hits_(_tsoffset_(-1,"y"),"y"))."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN008,FALSE,($dat__counter-$dat__started["counter"]))."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN009,FALSE,round(($dat__counter-$dat__started["counter"])/_pastdays_($dat__started["timestamp"],3),1))."</p>";
 echo"<p class=\"title\">"._strlan_(LAN010)."</p>";

 if($cnf__mtime_unique_accs===0)
  echo"<p class=\"summary\">"._strlan_(LAN011)."</p>";
 else{
  echo"<p class=\"summary\">"._strlan_(LAN012,FALSE,round(floor($cnf__mtime_unique_accs/60),0),$cnf__mtime_unique_accs%60)."</p>";
  echo (($cnf__expire_on_midnight)?("<p class=\"summary\">"._strlan_(LAN013)."</p>"):"");
  echo"<p class=\"summary\">".(($cnf__count_per_pages)?_strlan_(LAN014):_strlan_(LAN015))."</p>";
 }

 echo"<p class=\"title\">"._strlan_(LAN016)."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN017,FALSE,$__max4d["hits"],_strdate_($__max4d["timestamp"],"d"),FALSE,_strdate_($__max4d["timestamp"],"w"))."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN018,FALSE,$__max4m["hits"],_strdate_($__max4m["timestamp"],"m"))."</p>";
 echo"<p class=\"title\">"._strlan_(LAN019)."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN020,FALSE,_filename_(CONFIG_FILES,$par__id))."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN021,FALSE,_filename_(DATA_FILES,$par__id),_filesize_(DATA_FOLDER._filename_(DATA_FILES,$par__id)))."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN022,FALSE,_strdate_($dat__started["timestamp"],"d"),$dat__started["counter"],FALSE,_strdate_($__max4d["timestamp"],"w"))."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN023,FALSE,_pastdays_($dat__started["timestamp"],0),$dat__counter)."</p>";
 echo"<p class=\"title\">"._strlan_(LAN024)."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN025,FALSE,phpversion())."</p>";
 echo"<p class=\"summary\">".(($__gd!==FALSE)?_strlan_(LAN026,FALSE,$__gd["GD Version"]):_strlan_(LAN027))."</p>";
 echo"<p class=\"summary\">"._strlan_(LAN028,FALSE,VERSION)."</p>";
 return;
}

############################################################################################
# PANNELLO DEGLI ULTIMI ACCESSI
############################################################################################

function _panel1_(){
 global $cnf__last_entries;
 global $dat__entry;
 global $inf__country;

 echo"<p class=\"title\">"._strlan_(LAN101,FALSE,$cnf__last_entries)."</p>";

 foreach(array_reverse($dat__entry,TRUE) as $__entry=>$__data){
  $__ip=($__data["ip"]!=="")?$__data["ip"]:("<span class=\"unknown\">"._strlan_(LAN_UNKNOWN_IP,TRUE)."</span>");
  $__host=($__data["host"]!=="")?_strlan_($__data["host"],TRUE):FALSE;
  $__hostext=(preg_match("/\.([a-z]{2,4})$/i",$__data["host"],$__res)&&array_key_exists(strtolower($__res[1]),$inf__country))?strtolower($__res[1]):FALSE;
  $__cou2l=($__hostext!==FALSE)?strtoupper($__hostext):("<span class=\"unknown\">"._strlan_(LAN_UNKNOWN_COUNTRY,TRUE)."</span>");
  $__cou=($__hostext!==FALSE)?_strlan_($inf__country[$__hostext],TRUE):FALSE;
  $__age=($__data["age"]!=="")?_strlan_($__data["age"],TRUE):("<span class=\"unknown\">"._strlan_(LAN_UNKNOWN_BROWSER,TRUE)."</span>");
  $__os=($__data["os"]!=="")?_strlan_($__data["os"],TRUE):("<span class=\"unknown\">"._strlan_(LAN_UNKNOWN_OS,TRUE)."</span>");
  $__loc=($__data["loc"]!=="")?_strlan_(urldecode($__data["loc"]),TRUE):FALSE;
  $__strloc=($__loc!==FALSE)?("<a href=\"".$__loc."\" title=\"".$__loc."\">"._strcut_($__loc,70)."</a>"):("<span class=\"unknown\">"._strlan_(LAN_UNKNOWN_LOCATION,TRUE)."</span>");
  $__ref=($__data["ref"]!=="")?_strlan_(urldecode($__data["ref"]),TRUE):FALSE;
  $__strref=($__ref!==FALSE)?("<a href=\"".$__ref."\" title=\"".$__ref."\">"._strcut_($__ref,70)."</a>"):("<span class=\"unknown\">"._strlan_(LAN_UNKNOWN_REFERRER,TRUE)."</span>");
  $__eng=($__data["eng"]!=="")?_strlan_($__data["eng"],TRUE):FALSE;
  $__enk=($__data["enk"]!=="")?_strlan_($__data["enk"],TRUE):FALSE;
  $__strrefeng=(($__eng!==FALSE)&&($__enk!==FALSE))?("<a href=\"http://www.".$__eng."\" title=\"http://www.".$__eng."\">".ucfirst(_strcut_($__eng,30))."</a> ("._strcut_($__enk,40).")"):$__strref;

  echo"<table cellspacing=\"0\" cellpadding=\"0\" class=\"entry\">";
  echo"<tr>";
  echo"<td colspan=\"2\" class=\"header\">";
  echo"<p>"._strlan_(LAN102,TRUE)."</p>";
  echo"</td>";
  echo"<td colspan=\"2\" class=\"entry\">";
  echo"<p>".$__entry."</p>";
  echo"</td>";
  echo"<td colspan=\"6\" class=\"date\">";
  echo"<p>"._strdate_($__data["ts"],"w").", "._strdate_($__data["ts"],"d")." ".date("H:i",$__data["ts"])."</p>";
  echo"</td>";
  echo"<tr>";
  echo"<td colspan=\"2\" class=\"header\">";
  echo"<p>"._strlan_(LAN103,TRUE)."</p>";
  echo"</td>";
  echo"<td colspan=\"2\" class=\"header\">";
  echo"<p>"._strlan_(LAN104,TRUE)."</p>";
  echo"</td>";
  echo"<td colspan=\"3\" class=\"header\">";
  echo"<p>"._strlan_(LAN105,TRUE)."</p>";
  echo"</td>";
  echo"<td colspan=\"3\" class=\"header\">";
  echo"<p>"._strlan_(LAN106,TRUE)."</p>";
  echo"</td>";
  echo"</tr>";
  echo"<tr>";
  echo"<td colspan=\"2\" class=\"country\">";
  echo"<p title=\"".$__cou."\" style=\"cursor:help;\">".$__cou2l."</p>";
  echo"</td>";
  echo"<td colspan=\"2\" class=\"ip\">";
  echo"<p title=\"".$__host."\" style=\"cursor:help;\">".$__ip."</p>";
  echo"</td>";
  echo"<td colspan=\"3\" class=\"browser\">";
  echo"<p>".$__age."</p>";
  echo"</td>";
  echo"<td colspan=\"3\" class=\"os\">";
  echo"<p>".$__os."</p>";
  echo"</td>";
  echo"</tr>";
  echo"<tr>";
  echo"<td colspan=\"2\" class=\"header\">";
  echo"<p>"._strlan_(LAN107,TRUE)."</p>";
  echo"</td>";
  echo"<td colspan=\"8\" class=\"location\">";
  echo"<p>".$__strloc."</p>";
  echo"</td>";
  echo"</tr>";
  echo"<tr>";
  echo"<td colspan=\"2\" class=\"header\">";
  echo"<p>"._strlan_(LAN108,TRUE)."</p>";
  echo"</td>";
  echo"<td colspan=\"8\" class=\"referrer\">";
  echo"<p>".$__strrefeng."</p>";
  echo"</td>";
  echo"</tr>";
  echo"</table>";
 }

 return;
}

############################################################################################
# PANNELLO DELLE LOCAZIONI
############################################################################################

function _panel2_(){
 global $dat__location;

 _graph_($dat__location,"url",LAN201,LAN202,LAN203,LAN204,7,2,1,LAN_UNKNOWN_LOCATION,60,TRUE);
 _graph_(_domains_($dat__location),"url",LAN205,LAN206,LAN207,LAN208,6,3,1,LAN_UNKNOWN_LOCATION,50,TRUE);
 return;
}

############################################################################################
# PANNELLO DELLE PROVENIENZE
############################################################################################

function _panel3_(){
 global $dat__referrer,$dat__engine,$dat__enkey;

 _graph_($dat__referrer,"url",LAN301,LAN302,LAN303,LAN304,7,2,1,LAN_UNKNOWN_REFERRER,60,TRUE);
 _graph_(_domains_($dat__referrer),"url",LAN305,LAN306,LAN307,LAN308,6,3,1,LAN_UNKNOWN_REFERRER,50,TRUE);
 _graph_($dat__engine,"engine",LAN309,LAN310,LAN311,LAN312,5,4,1,FALSE,40,TRUE);
 _graph_($dat__enkey,"other",LAN313,LAN314,LAN315,LAN316,5,4,1,FALSE,40,TRUE);
 return;
}

############################################################################################
# PANNELLO DEGLI UTENTI
############################################################################################

function _panel4_(){
 global $dat__browser,$dat__os,$dat__provider,$dat__country;

 _graph_($dat__browser,"other",LAN401,LAN402,LAN403,LAN404,5,4,1,LAN_UNKNOWN_BROWSER,40,TRUE);
 _graph_($dat__os,"other",LAN405,LAN406,LAN407,LAN408,5,4,1,LAN_UNKNOWN_OS,40,TRUE);
 _graph_($dat__provider,"other",LAN409,LAN410,LAN411,LAN412,5,4,1,LAN_UNKNOWN_PROVIDER,40,TRUE);
 _graph_($dat__country,"country",LAN413,LAN414,LAN415,LAN416,5,4,1,LAN_UNKNOWN_COUNTRY,40,TRUE);
 return;
}

############################################################################################
# PANNELLO DEL CALENDARIO
############################################################################################

function _panel5_(){
 global $dat__day,$dat__time;
 global $aux__calendar;

 for($__days=array(),$__count=-30;$__count<=0;$__count++)
  $__days[$__ts=_tsoffset_($__count,"d")]=$aux__calendar->_get_hits_($__ts,"d");

 for($__months=array(),$__count=-11;$__count<=0;$__count++)
  $__months[$__ts=_tsoffset_($__count,"m")]=$aux__calendar->_get_hits_($__ts,"m");

 _graph_($__days,"day",LAN501,LAN502,LAN503,LAN504,4,5,1,FALSE,30,FALSE);
 _graph_($__months,"mounth",LAN505,LAN506,LAN507,LAN508,4,5,1,FALSE,30,FALSE);
 _graph_($aux__calendar->_get_years_(),"other",LAN509,LAN510,LAN511,LAN512,4,5,1,FALSE,30,FALSE);
 _graph_($dat__day,"week",LAN513,LAN514,LAN515,LAN516,4,5,1,FALSE,30,FALSE);
 _graph_($dat__time,"hour",LAN517,LAN518,LAN519,LAN520,4,5,1,FALSE,30,FALSE);
 return;
}

############################################################################################
# FUNZIONI LOCALI
############################################################################################

function _strlan_($__string,$__strip=FALSE,$__par1=FALSE,$__par2=FALSE,$__par3=FALSE,$__par4=FALSE){
 settype($__string,"string");
 settype($__strip,"boolean");
 settype($__par1,"string");
 settype($__par2,"string");
 settype($__par3,"string");
 settype($__par4,"string");

 static $__tags=array(
  "/\[date\]/i",
  "/\[\/date\]/i",
  "/\[hi\]/i",
  "/\[\/hi\]/i",
  "/\[count\]/i",
  "/\[\/count\]/i"
 );

 static $__reps=array(
  "<span title=\"%4\$s\" class=\"hi\" style=\"cursor:help;\">",
  "</span>",
  "<span class=\"hi\">",
  "</span>",
  "<span class=\"count\">",
  "</span>"
 );

 static $__noreps=array("","","","","","");

 return (sprintf(preg_replace($__tags,($__strip)?$__noreps:$__reps,htmlspecialchars(preg_replace("/[\\x00-\x1F\\x5C]/","",$__string),ENT_QUOTES)),$__par1,$__par2,$__par3,$__par4));
}

function _strcut_($__string,$__length){
 settype($__string,"string");
 settype($__length,"integer");

 return (strlen($__string)>$__length)?(substr($__string,0,$__length-3)."..."):$__string;
}

function _strdate_($__timestamp,$__type="d"){
 settype($__timestamp,"integer");
 settype($__type,"string");

 $__months=explode(",",LAN_MONTHS,12);
 $__days=explode(",",LAN_DAYS,7);

 switch(strtolower($__type{0})){
  case "w":
   return $__days[(6+date("w",$__timestamp))%7];
  case "m":
   return ($__months[date("n",$__timestamp)-1]." ".date("Y",$__timestamp));
  default:
   return (date("j",$__timestamp)." ".$__months[date("n",$__timestamp)-1]." ".date("Y",$__timestamp));
 }
}

function _tsoffset_($__offset,$__type="d"){
 settype($__offset,"integer");
 settype($__type,"string");

 global $aux__now;

 switch(strtolower($__type{0})){
  case "y":
   return mktime(12,0,0,1,1,date("Y",$aux__now)+$__offset);
  case "m":
   return mktime(12,0,0,date("n",$aux__now)+$__offset,1,date("Y",$aux__now));
  default:
   return mktime(12,0,0,date("n",$aux__now),date("j",$aux__now)+$__offset,date("Y",$aux__now));
 }
}

function _pastdays_($__timestamp,$__prec=0){
 settype($__timestamp,"integer");
 settype($__prec,"integer");

 global $aux__now;

 return ((($__days=round(($aux__now-$__timestamp)/(24*60*60),$__prec))<1)?1:$__days);
}

function _restrict_($__data){
 settype($__data,"array");

 global $cnf__limit_view;

 $__unknown=0;
 $__cut=0;

 if(array_key_exists("#!",$__data)){
  $__cut=$__data["#!"];
  unset($__data["#!"]);
 }

 if(array_key_exists("#?",$__data)){
  $__unknown=$__data["#?"];
  unset($__data["#?"]);
 }

 $__restrict=_array_slice_($__data,0,$cnf__limit_view);
 $__restrict["#!"]=$__cut+array_sum(_array_slice_($__data,$cnf__limit_view));
 $__restrict["#?"]=$__unknown;

 if($__restrict["#!"]===0)
  unset($__restrict["#!"]);

 if($__restrict["#?"]===0)
  unset($__restrict["#?"]);

 return $__restrict;
}

function _percentage_($__data,$__prec=1){
 settype($__data,"array");
 settype($__prec,"integer");

 $__percentage=array("#^"=>(count($__data)>0)?max($__data):0,"#+"=>array_sum($__data));

 foreach($__data as $__item=>$__hits)
  $__percentage[$__item]=($__percentage["#+"]<1)?0:round(100*$__hits/$__percentage["#+"],$__prec);

 return $__percentage;
}

function _strbar_($__hits,$__max){
 settype($__hits,"integer");
 settype($__max,"integer");

 $__len=($__max<1)?0:round(60*$__hits/$__max,0);
 $__len=(0===(int)$__len)?1:$__len;

 return ("<table cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%;height:auto;\">".
         "<tr>".
         "<td class=\"bar\" style=\"width:".$__len."%;\">".
         "<span style=\"font-size:1px;\">&nbsp;</span>".
         "</td>".
         "<td class=\"hits\">".
         $__hits.
         "</td>".
         "</tr>".
         "</table>");
}

function _graph_($__data,$__type,$__title,$__header1,$__header2,$__header3,$__colsize1,$__colsize2,$__colsize3,$__unknownitem,$__strcut,$__restrict){
 settype($__data,"array");
 settype($__type,"string");
 settype($__title,"string");
 settype($__header1,"string");
 settype($__header2,"string");
 settype($__header3,"string");
 settype($__colsize1,"integer");
 settype($__colsize2,"integer");
 settype($__colsize3,"integer");
 settype($__unknownitem,"string");
 settype($__strcut,"integer");
 settype($__restrict,"boolean");

 global $inf__country;

 $__days=explode(",",LAN_DAYS,7);
 $__data=($__restrict)?_restrict_($__data):$__data;
 $__perc=_percentage_($__data,1);

 echo"<p class=\"title\">"._strlan_($__title,FALSE)."</p>";
 echo"<table cellspacing=\"0\" cellpadding=\"0\" class=\"graph\">";
 echo"<tr>";
 echo"<td colspan=\"".$__colsize1."\" class=\"header\">";
 echo"<p>"._strlan_($__header1,TRUE)."</p>";
 echo"</td>";
 echo"<td colspan=\"".$__colsize2."\" class=\"header\">";
 echo"<p>"._strlan_($__header2,TRUE)."</p>";
 echo"</td>";
 echo"<td colspan=\"".$__colsize3."\" class=\"header\">";
 echo"<p>"._strlan_($__header3,TRUE)."</p>";
 echo"</td>";
 echo"</tr>";

 if(count($__data)>0)
  foreach($__data as $__item=>$__hits){
   if($__item==="#?")
    $__stritem="<span class=\"unknown\">"._strlan_($__unknownitem,TRUE)."</span>";
   elseif($__item==="#!")
    $__stritem="<span class=\"other\">"._strlan_(LAN_OTHER,TRUE)."</span>";
   else{
    switch(strtolower($__type{0})){
     case "u":
      $__address=_strlan_(urldecode($__item),TRUE);
      $__stritem="<a href=\"".$__address."\" title=\"".$__address."\">"._strcut_($__address,$__strcut)."</a>";
      break;
     case "e":
      $__address=_strlan_($__item,TRUE);
      $__stritem="<a href=\"http://www.".$__address."\" title=\"http://www.".$__address."\">".ucfirst(_strcut_($__address,$__strcut))."</a>";
      break;
     case "c":
      $__stritem=_strlan_(_strcut_((array_key_exists($__item,$inf__country))?$inf__country[$__item]:$__item,$__strcut),TRUE);
      break;
     case "h":
      $__stritem=sprintf("%02d:00 ".chr(247)." %02d:00",$__item,$__item+1);
      break;
     case "d":
      $__stritem="<span title=\""._strlan_(_strdate_($__item,"w"),TRUE)."\"".(((int)date("w",$__item)===0)?" class=\"sunday\"":"")." style=\"cursor:help;\">"._strlan_(_strcut_(_strdate_($__item,"d"),$__strcut),TRUE)."</span>";
      break;
     case "w":
      $__stritem=_strlan_(_strcut_($__days[$__item],$__strcut),TRUE);
      $__stritem=($__item===6)?("<span class=\"sunday\">".$__stritem."</span>"):$__stritem;
      break;
     case "m":
      $__stritem=_strlan_(_strcut_(_strdate_($__item,"m"),$__strcut),TRUE);
      break;
     default:
      $__stritem=_strlan_(_strcut_($__item,$__strcut),TRUE);
    }
   }

   echo"<tr>";
   echo"<td colspan=\"".$__colsize1."\" class=\"item\">";
   echo"<p>".$__stritem."</p>";
   echo"</td>";
   echo"<td colspan=\"".$__colsize2."\" class=\"chart\">";
   echo _strbar_($__hits,$__perc["#^"]);
   echo"</td>";
   echo"<td colspan=\"".$__colsize3."\" class=\"percentage\">";
   echo"<p>".$__perc[$__item]."</p>";
   echo"</td>";
   echo"</tr>";
  }
 else{
  echo"<tr>";
  echo"<td colspan=\"".($__colsize1+$__colsize2+$__colsize3)."\" class=\"item\">";
  echo"<p>"._strlan_(LAN_EMPTY,TRUE)."</p>";
  echo"</td>";
  echo"</tr>";
 }

 echo"</table>";
 return;
}

function _domains_($__data){
 settype($__data,"array");

 $__domains=array("#?"=>(array_key_exists("#?",$__data))?$__data["#?"]:0,"#!"=>(array_key_exists("#!",$__data))?$__data["#!"]:0);
 unset($__data["#?"],$__data["#!"]);

 foreach($__data as $__item=>$__hits)
  if(preg_match("/^((http%3A%2F%2F|https%3A%2F%2F|ftp%3A%2F%2F)[^%]+)/",$__item,$__res)){
   if(array_key_exists($__res[1],$__domains))
    $__domains[$__res[1]]+=$__hits;
   else
    $__domains[$__res[1]]=$__hits;
  }
  else
   $__domains["#?"]+=$__hits;

 arsort($__domains,SORT_NUMERIC);
 return $__domains;
}

############################################################################################

?>