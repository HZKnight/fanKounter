<?php /* mak.inc.php
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
 Modulo importato per la creazione al volo di un'istanza di contatore.

      */

############################################################################################
# BLOCCO ESECUZIONE STANDALONE
############################################################################################

if(!defined("STANDALONE"))
 exit();

############################################################################################
# VARIABILI LOCALI
############################################################################################

settype($cnf__htime_sync_server,"integer");

$aux__now=NOW+$cnf__htime_sync_server*3600;
$aux__location=new URL((array_key_exists("HTTP_REFERER",$_SERVER))?$_SERVER["HTTP_REFERER"]:FALSE);

############################################################################################
# COSTRUZIONE DI UN CONTATORE
############################################################################################

return (_licit_request_())?_make_counter_():FALSE;

############################################################################################
# FUNZIONI LOCALI
############################################################################################

function _licit_request_(){
 global $aux__location;

 if(($__normloc=$aux__location->_normalize_())===FALSE)
  return FALSE;
 else
  foreach(explode(",",preg_replace("/\s*[,;]+\s*/",",",trim(MAKE_PATHS))) as $__path){
   $__pathobj=new URL($__path);

   if(($__normpath=$__pathobj->_normalize_())!==FALSE)
    if(preg_match("/^".preg_quote($__normpath,"/")."/",$__normloc))
     return TRUE;
  }

 return FALSE;
}

function _make_counter_(){
 global $par__id;
 global $cnf__username,$cnf__usermail,$cnf__userpass,$cnf__start_count,$cnf__mtime_unique_accs,$cnf__expire_on_midnight,$cnf__count_per_pages,$cnf__licit_domains_list,$cnf__IPmasks_ignore_list,$cnf__htime_sync_server,$cnf__last_entries,$cnf__passwd_protect,$cnf__limit_view;
 global $aux__now,$aux__location;

 settype($cnf__username,"string");
 settype($cnf__usermail,"string");
 settype($cnf__userpass,"string");
 settype($cnf__start_count,"integer");
 settype($cnf__mtime_unique_accs,"integer");
 settype($cnf__expire_on_midnight,"boolean");
 settype($cnf__count_per_pages,"boolean");
 settype($cnf__licit_domains_list,"array");
 settype($cnf__IPmasks_ignore_list,"array");
 settype($cnf__htime_sync_server,"integer");
 settype($cnf__last_entries,"integer");
 settype($cnf__passwd_protect,"boolean");
 settype($cnf__limit_view,"integer");

 $__data="";
 $__data.="<?php".EOL.EOL;
 $__data.="# The configuration file for '".$par__id."' counter.".EOL;
 $__data.="# This file was created by fanKounter on ".date("d.m.Y, H:i",$aux__now).".".EOL.EOL;
 $__data.="// \$cnf__username = \"".preg_replace("/[\\x00-\x1F\x22\x24\\x5C]/","",$cnf__username)."\";".EOL;
 $__data.="// \$cnf__usermail = \"".preg_replace("/[\\x00-\x1F\x22\x24\\x5C]/","",$cnf__usermail)."\";".EOL;
 $__data.="// \$cnf__userpass = \"".preg_replace("/[\\x00-\x1F\x22\x24\\x5C]/","",$cnf__userpass)."\";".EOL;
 $__data.="// \$cnf__start_count = ".$cnf__start_count.";".EOL;
 $__data.="// \$cnf__mtime_unique_accs = ".$cnf__mtime_unique_accs.";".EOL;
 $__data.="// \$cnf__expire_on_midnight = ".(($cnf__expire_on_midnight)?"TRUE":"FALSE").";".EOL;
 $__data.="// \$cnf__count_per_pages = ".(($cnf__count_per_pages)?"TRUE":"FALSE").";".EOL;

 $__paths=array(preg_replace("/[\\x00-\x1F\x22\x24\\x5C]/","",urldecode($aux__location->_normalize_())));

 foreach($cnf__licit_domains_list as $__path){
  $__pathobj=new URL($__path);

  if(($__normpath=$__pathobj->_normalize_())!==FALSE)
   array_push($__paths,preg_replace("/[\\x00-\x1F\x22\x24\\x5C]/","",urldecode($__normpath)));
 }

 $__data.="// \$cnf__licit_domains_list = array(\"".implode("\",\"",array_unique($__paths))."\");".EOL;
 $__data.="// \$cnf__IPmasks_ignore_list = array(";

 for($__count=0;$__count<count($cnf__IPmasks_ignore_list);$__count++)
  $__data.=(($__count>0)?",":"")."\"".preg_replace("/[\\x00-\x1F\x22\x24\\x5C]/","",$cnf__IPmasks_ignore_list[$__count])."\"";

 $__data.=");".EOL;

 $__data.="// \$cnf__htime_sync_server = ".$cnf__htime_sync_server.";".EOL;
 $__data.="// \$cnf__last_entries = ".$cnf__last_entries.";".EOL;
 $__data.="// \$cnf__passwd_protect = ".(($cnf__passwd_protect)?"TRUE":"FALSE").";".EOL;
 $__data.="// \$cnf__limit_view = ".$cnf__limit_view.";".EOL.EOL;
 $__data.="?>";

 _fcreate_(CONFIG_FOLDER._filename_(CONFIG_FILES,$par__id),$__data);
 return $par__id;
}

############################################################################################

?>