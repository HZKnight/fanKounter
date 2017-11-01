<?php /* counter.php
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
 Modulo motore per la rilevazione, l'elaborazione e la memorizzazione dei dati statistici.

      */

############################################################################################
# INCLUSIONE DEI MODULI
############################################################################################

define("STANDALONE",FALSE);

require("ver.inc.php");
require("sys.inc.php");
require("cnf.inc.php");
require("dic.inc.php");
require("url.inc.php");
require("cal.inc.php");

############################################################################################
# CREAZIONE DELLE CARTELLE DI LAVORO
############################################################################################

_mkdir_(CONFIG_FOLDER);
_mkdir_(DATA_FOLDER);
_mkdir_(BACKUP_FOLDER);
_mkdir_(TEMP_FOLDER);

############################################################################################
# PARAMETRI IN INPUT
############################################################################################

$par__id=(isset($par__id)&&preg_match("/^[a-z\d]+$/i",$par__id))?$par__id:FALSE;
$par__mode=(isset($par__mode)&&preg_match("/^(graphic|text|hidden)$/i",$par__mode))?strtolower($par__mode):"graphic";
$par__referrer=(isset($par__referrer)&&($par__referrer!==""))?$par__referrer:FALSE;

############################################################################################
# ACQUISIZIONE/CREAZIONE DELLA CONFIGURAZIONE DI UN CONTATORE
############################################################################################

if($par__id!==FALSE){
 if(file_exists(CONFIG_FOLDER._filename_(CONFIG_FILES,$par__id))){
  require(CONFIG_FOLDER._filename_(CONFIG_FILES,$par__id));
 }
 else{
  $par__id=require("mak.inc.php");
 }
}

settype($cnf__start_count,"integer");
settype($cnf__mtime_unique_accs,"integer");
settype($cnf__expire_on_midnight,"boolean");
settype($cnf__count_per_pages,"boolean");
settype($cnf__licit_domains_list,"array");
settype($cnf__IPmasks_ignore_list,"array");
settype($cnf__htime_sync_server,"integer");
settype($cnf__last_entries,"integer");

############################################################################################
# DEFINIZIONE DELLE STRUTTURE DATI E DELLE VARIABILI DI SUPPORTO
############################################################################################

$aux__now=NOW+$cnf__htime_sync_server*3600;
$aux__ip=(array_key_exists("HTTP_CLIENT_IP",$_SERVER))?$_SERVER["HTTP_CLIENT_IP"]:((array_key_exists("REMOTE_ADDR",$_SERVER))?$_SERVER["REMOTE_ADDR"]:FALSE);
$aux__ip=(preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/",$aux__ip))?$aux__ip:FALSE;
$aux__agent=(array_key_exists("HTTP_USER_AGENT",$_SERVER))?$_SERVER["HTTP_USER_AGENT"]:FALSE;
$aux__location=new URL((array_key_exists("HTTP_REFERER",$_SERVER))?$_SERVER["HTTP_REFERER"]:FALSE);
$aux__referrer=new Referrer($par__referrer);
$aux__calendar=new Calendar;

$dat__counter=($cnf__start_count<0)?0:$cnf__start_count;
$dat__started=array("timestamp"=>$aux__now,"counter"=>($cnf__start_count<0)?0:$cnf__start_count);
$dat__cuttime=NOW+CUTTIME;
$dat__calendar=array();
$dat__day=array_fill(0,7,0);
$dat__time=array_fill(0,24,0);
$dat__country=array("#?"=>0);
$dat__browser=array("#?"=>0);
$dat__os=array("#?"=>0);
$dat__provider=array("#?"=>0,"#!"=>0);
$dat__location=array("#?"=>0,"#!"=>0);
$dat__referrer=array("#?"=>0,"#!"=>0);
$dat__engine=array();
$dat__enkey=array("#!"=>0);
$dat__entry=array();

############################################################################################
# LA FINE PER UN'ISTANZA DI CONTATORE NON VALIDA
############################################################################################

if($par__id===FALSE){
 require("out.inc.php");
 exit();
}

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

$aux__calendar->_update_($dat__calendar);

############################################################################################
# ELIMINAZIONE PERIODICA DEI DATI STATISTICI OBSOLETI
############################################################################################

if(NOW>$dat__cuttime){
 $dat__cuttime=NOW+CUTTIME;

 _datacut_($dat__provider);
 _datacut_($dat__location);
 _datacut_($dat__referrer);
 _datacut_($dat__enkey);

 _fdel_(TEMP_FOLDER._filename_(ACCESS_FILES,$par__id));
}

############################################################################################
# AGGIORNAMENTO DEI DATI STATISTICI
############################################################################################

if(_licit_ip_())
 if(_licit_domain_())
  if(_unique_accs_())
   if($aux__calendar->_set_hit_($aux__now)){

// Aggiornamento degli ultimi accessi

    $__host=(HOSTNAME&&($aux__ip!==FALSE))?gethostbyaddr($aux__ip):FALSE;
    $__host=($__host!==$aux__ip)?$__host:FALSE;

    $dat__entry[++$dat__counter]=array();
    $dat__entry[$dat__counter]["ts"]=$aux__now;
    $dat__entry[$dat__counter]["ip"]=$aux__ip;
    $dat__entry[$dat__counter]["host"]=$__host;
    $dat__entry[$dat__counter]["age"]=_infosys_($aux__agent,$inf__browser);
    $dat__entry[$dat__counter]["os"]=_infosys_($aux__agent,$inf__os);
    $dat__entry[$dat__counter]["loc"]=$aux__location->_normalize_();

    if($aux__referrer->_is_engine_()){
     $dat__entry[$dat__counter]["ref"]=FALSE;
     $dat__entry[$dat__counter]["eng"]=$aux__referrer->_get_engine_name_();
     $dat__entry[$dat__counter]["enk"]=implode(" ",$aux__referrer->_get_engine_keys_());
    }
    else{
     $dat__entry[$dat__counter]["ref"]=$aux__referrer->_normalize_();
     $dat__entry[$dat__counter]["eng"]=FALSE;
     $dat__entry[$dat__counter]["enk"]=FALSE;
    }

// Aggiornamento delle strutture dati

    _update_((6+date("w",$dat__entry[$dat__counter]["ts"]))%7,$dat__day);
    _update_((integer)date("G",$dat__entry[$dat__counter]["ts"]),$dat__time);
    _update_((preg_match("/\.([a-z]{2,4})$/i",$dat__entry[$dat__counter]["host"],$__res)&&array_key_exists(strtolower($__res[1]),$inf__country))?strtolower($__res[1]):"#?",$dat__country,TRUE);
    _update_(($dat__entry[$dat__counter]["age"]!==FALSE)?$dat__entry[$dat__counter]["age"]:"#?",$dat__browser,TRUE);
    _update_(($dat__entry[$dat__counter]["os"]!==FALSE)?$dat__entry[$dat__counter]["os"]:"#?",$dat__os,TRUE);
    _update_((preg_match("/\.(([a-z]|[a-z][a-z\d\-]*[a-z\d])\.[a-z]{2,4})$/i",$__host,$__res))?strtolower($__res[1]):"#?",$dat__provider,TRUE);
    _update_(($dat__entry[$dat__counter]["loc"]!==FALSE)?$dat__entry[$dat__counter]["loc"]:"#?",$dat__location,TRUE);

    if($aux__referrer->_is_engine_()){
     _update_($aux__referrer->_get_engine_name_(),$dat__engine,TRUE);

     foreach($aux__referrer->_get_engine_keys_() as $__enkey)
      _update_($__enkey,$dat__enkey,TRUE);
    }
    else
     _update_(($dat__entry[$dat__counter]["ref"]!==FALSE)?$dat__entry[$dat__counter]["ref"]:"#?",$dat__referrer,TRUE);

// Riordino dei dati

    while(count($dat__entry)>$cnf__last_entries){
     ksort($dat__entry,SORT_NUMERIC);
     reset($dat__entry);
     unset($dat__entry[key($dat__entry)]);
    }

    arsort($dat__country,SORT_NUMERIC);
    arsort($dat__browser,SORT_NUMERIC);
    arsort($dat__os,SORT_NUMERIC);
    arsort($dat__provider,SORT_NUMERIC);
    arsort($dat__location,SORT_NUMERIC);
    arsort($dat__referrer,SORT_NUMERIC);
    arsort($dat__engine,SORT_NUMERIC);
    arsort($dat__enkey,SORT_NUMERIC);

// Creazione del buffer del database

    $__data="";
    $__data.="<?php".EOL.EOL;
    $__data.="# The database file for '".$par__id."' counter.".EOL;
    $__data.="# This file was created by fanKounter on ".date("d.m.Y, H:i",$aux__now).".".EOL.EOL;
    $__data.="\$dat__counter=".$dat__counter.";".EOL;
    $__data.=_datastore_($dat__started,"dat__started");
    $__data.="\$dat__cuttime=".$dat__cuttime.";".EOL;
    $__data.=$aux__calendar->_safe_("dat__calendar");
    $__data.=_datastore_($dat__day,"dat__day",TRUE,FALSE);
    $__data.=_datastore_($dat__time,"dat__time",TRUE,FALSE);
    $__data.=_datastore_($dat__country,"dat__country");
    $__data.=_datastore_($dat__browser,"dat__browser");
    $__data.=_datastore_($dat__os,"dat__os");
    $__data.=_datastore_($dat__provider,"dat__provider");
    $__data.=_datastore_($dat__location,"dat__location");
    $__data.=_datastore_($dat__referrer,"dat__referrer");
    $__data.=_datastore_($dat__engine,"dat__engine");
    $__data.=_datastore_($dat__enkey,"dat__enkey");

    foreach($dat__entry as $__entry=>$__elem)
     $__data.=_datastore_($__elem,"dat__entry[".$__entry."]",FALSE);

    $__data.=EOL."?>";

// Salvataggio sicuro del file di database

    _fcopy_(DATA_FOLDER._filename_(DATA_FILES,$par__id),BACKUP_FOLDER._filename_(DATA_FILES,$par__id));
    _fcreate_(DATA_FOLDER._filename_(DATA_FILES,$par__id),$__data);
    set_error_handler("_die_");
    require(DATA_FOLDER._filename_(DATA_FILES,$par__id));
    restore_error_handler();
    _fdel_(BACKUP_FOLDER._filename_(DATA_FILES,$par__id));
   }

############################################################################################
# RILASCIO DELLE RISORSE ACQUISITE
############################################################################################

_funlock_();

############################################################################################
# STAMPA DEL CONTATORE
############################################################################################

require("out.inc.php");
exit();

############################################################################################
# FUNZIONI LOCALI
############################################################################################

function _licit_ip_(){
 global $cnf__IPmasks_ignore_list;
 global $aux__ip;

 foreach($cnf__IPmasks_ignore_list as $__ip)
  if(preg_match("/^".preg_replace("/\\x5C\\x3F/","\\d",preg_replace("/\\x5C\\x2A/","\\d{1,3}",preg_quote($__ip,"/")))."$/",$aux__ip))
   return FALSE;

 return TRUE;
}

function _licit_domain_(){
 global $cnf__licit_domains_list;
 global $aux__location;

 if(count($cnf__licit_domains_list)===0)
  return TRUE;
 elseif(($__normloc=$aux__location->_normalize_())===FALSE)
  return FALSE;
 else
  foreach($cnf__licit_domains_list as $__path){
   $__pathobj=new URL($__path);

   if(($__normpath=$__pathobj->_normalize_())!==FALSE)
    if(preg_match("/^".preg_quote($__normpath,"/")."/",$__normloc))
     return TRUE;
  }

 return FALSE;
}

function _unique_accs_(){
 global $par__id;
 global $cnf__mtime_unique_accs,$cnf__expire_on_midnight,$cnf__count_per_pages;
 global $aux__now,$aux__ip,$aux__agent,$aux__location;

 $__times=array();
 $__infos=array();
 $__entries=(file_exists(TEMP_FOLDER._filename_(ACCESS_FILES,$par__id)))?file(TEMP_FOLDER._filename_(ACCESS_FILES,$par__id)):array();

 foreach($__entries as $__entry){
  list($__expire,$__info)=explode(",",$__entry,2);

  if($aux__now<$__expire){
   array_push($__times,$__expire);
   array_push($__infos,preg_replace("/".preg_quote(EOL,"/")."$/i","",$__info));
  }
 }

 if(!in_array($__info=md5((($cnf__count_per_pages)?"":$aux__location->_normalize_()).$aux__ip.$aux__agent),$__infos)){
  $__expire=$aux__now+60*(($cnf__mtime_unique_accs>0)?$cnf__mtime_unique_accs:-60);
  $__expire=($cnf__expire_on_midnight)?min($__expire,mktime(0,0,0,date("n",$aux__now),1+date("j",$aux__now),date("Y",$aux__now))):$__expire;

  array_push($__times,$__expire);
  array_push($__infos,$__info);

  for($__buffer="",$__count=0;$__count<count($__times);$__count++)
   $__buffer.=$__times[$__count].",".$__infos[$__count].EOL;

  _fcreate_(TEMP_FOLDER._filename_(ACCESS_FILES,$par__id),$__buffer);
  return TRUE;
 }

 return FALSE;
}

function _datacut_(&$__data){
 settype($__data,"array");

 if(count($__data)>CUTSIZE){
  $__unknown=(array_key_exists("#?",$__data))?$__data["#?"]:FALSE;
  $__cut=(array_key_exists("#!",$__data))?$__data["#!"]:0;
  unset($__data["#?"],$__data["#!"]);

  $__datacut=_array_slice_($__data,0,CUTSIZE-1-(($__unknown!==FALSE)?1:0));

  if($__unknown!==FALSE)
   $__datacut["#?"]=$__unknown;

  $__datacut["#!"]=$__cut+array_sum(_array_slice_($__data,CUTSIZE-1-(($__unknown!==FALSE)?1:0)));

  arsort($__datacut,SORT_NUMERIC);
  $__data=$__datacut;
 }

 return;
}

function _infosys_($__elem,$__data){
 settype($__elem,"string");
 settype($__data,"array");

 foreach($__data as $__regexp=>$__name)
  if(preg_match($__regexp,$__elem))
   return preg_replace($__regexp,$__name,$__elem);

 return FALSE;
}

function _update_($__elem,&$__data,$__create=FALSE){
 settype($__elem,"string");
 settype($__data,"array");
 settype($__create,"boolean");

 if(array_key_exists($__elem,$__data))
  ++$__data[$__elem];
 elseif($__create)
  $__data[$__elem]=1;

 return;
}

function _datastore_($__data_arr,$__var_name,$__val_numeric=TRUE,$__safe_key=TRUE){
 settype($__data_arr,"array");
 settype($__var_name,"string");
 settype($__val_numeric,"boolean");
 settype($__safe_key,"boolean");

 $__the_first=TRUE;
 $__buffer="\$".$__var_name."=array(";

 foreach($__data_arr as $__key=>$__val){
  $__key=preg_replace("/[\\x00-\x1F\x22\x24\\x5C]/","",$__key);
  $__val=preg_replace("/[\\x00-\x1F\x22\x24\\x5C]/","",$__val);
  $__buffer.=(($__the_first)?"":",").(($__safe_key)?("\"".$__key."\"=>"):"").(($__val_numeric)?$__val:("\"".$__val."\""));
  $__the_first=FALSE;
 }

 $__buffer.=");".EOL;
 return $__buffer;
}

function _die_($__code,$__mesg){
 exit("Database corrupt!");
}

############################################################################################

?>