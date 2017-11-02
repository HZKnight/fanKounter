<?php /* sys.inc.php
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
 Modulo importato per gestire operazioni comuni su file e cartelle.

      */

############################################################################################
# VARIABILI LOCALI
############################################################################################

$__lock_fid=FALSE;

############################################################################################
# FUNZIONI GLOBALI
############################################################################################

function _mkdir_($__name,$__mode=0777){
 settype($__name,"string");

 clearstatcache();

 if(is_dir($__name))
  return;
 elseif(mkdir($__name,$__mode)){
  clearstatcache();

  if(is_dir($__name))
   return;
 }

 exit("System Error: _mkdir_(".$__name.",".$__mode.").");
}

function _fdel_($__name){
 settype($__name,"string");

 clearstatcache();

 if(!file_exists($__name))
  return;
 elseif(unlink($__name)){
  clearstatcache();

  if(!file_exists($__name))
   return;
 }

 exit("System Error: _fdel_(".$__name.").");
}

function _fcopy_($__source,$__target){
 settype($__source,"string");
 settype($__target,"string");

 clearstatcache();

 if(!file_exists($__source))
  return;
 elseif(copy($__source,$__target)){
  clearstatcache();

  if(file_exists($__target))
   if(file_get_contents($__target)===file_get_contents($__source))
    return;
 }

 _fdel_($__target);
 exit("System Error: _fcopy_(".$__source.",".$__target.").");
}

function _fcreate_($__name,$__content){
 settype($__name,"string");
 settype($__content,"string");

 if(($__fid=fopen($__name,"wb"))!==FALSE){
  if(fwrite($__fid,$__content)===strlen($__content)){
   fflush($__fid);
   fclose($__fid);
   clearstatcache();

   if(file_exists($__name))
    if(file_get_contents($__name)===$__content)
     return;
  }

  @fclose($__fid);
 }

 _fdel_($__name);
 exit("System Error: _fcreate_(".$__name.",...).");
}

function _flock_(){
 global $par__id;
 global $__lock_fid;

 if(FLOCK){
  if(($__lock_fid=fopen(TEMP_FOLDER._filename_(FLOCK_FILES,$par__id),"ab"))!==FALSE)
   if(flock($__lock_fid,LOCK_EX))
    return;

  @fclose($__lock_fid);
  exit("System Error: _flock_().");
 }

 return;
}

function _funlock_(){
 global $__lock_fid;

 if(FLOCK){
  flock($__lock_fid,LOCK_UN);
  fclose($__lock_fid);
 }

 return;
}

function _ls_($__dir="./",$__pattern="*.*"){
 settype($__dir,"string");
 settype($__pattern,"string");

 clearstatcache();

 $__ls=array();
 $__regexp=preg_replace("/\\x5C\\x3F/",".",preg_replace("/\\x5C\\x2A/",".*",preg_quote($__pattern,"/")));

 if(!is_dir($__dir))
  return $__ls;
 elseif(($__dir_id=opendir($__dir))!==FALSE){
  while(($__file=readdir($__dir_id))!==FALSE)
   if(preg_match("/^".$__regexp."$/",$__file))
    array_push($__ls,$__file);

  closedir($__dir_id);
  sort($__ls,SORT_STRING);
  return $__ls;
 }

 exit("System Error: _ls_(".$__dir.",".$__pattern.").");
}

function _filename_($__template,$__replace){
 settype($__template,"string");
 settype($__replace,"string");

 return preg_replace("/\\x2A/",$__replace,$__template);
}

function _filesize_($__name){
 settype($__name,"string");

 clearstatcache();
 return((file_exists($__name))?round(filesize($__name)/1024,1):0);
}

############################################################################################

?>