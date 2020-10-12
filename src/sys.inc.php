<?php 
/* 
 * sys.inc.php
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
 * Copyright (C) 2020 HZKnight
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
 * Modulo importato per gestire operazioni comuni su file e cartelle.
 * 
 *  @author  lucliscio <lucliscio@h0model.org>
 *  @version v 5.1
 *  @copyright Copyright 2020 HZKnight
 *  @copyright Copyright 2003 Fanatiko 
 *  @license http://www.gnu.org/licenses/agpl-3.0.html GNU/AGPL3
 *   
 *  @package fanKounter
 *  @filesource 
 */

############################################################################################
# COSTANTI E VARIABILI LOCALI
############################################################################################

define("WEB_ROOT", getcwd()."/");

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

  if(!file_exists(WEB_ROOT.$__name))
    return;
  elseif(unlink(WEB_ROOT.$__name)){
    clearstatcache();

    if(!file_exists(WEB_ROOT.$__name))
      return;
  }

  if(!is_writable(WEB_ROOT.$__name)){
    exit("System Error: _fdel_(".WEB_ROOT.$__name."). File not writable");
  }
  exit("System Error: _fdel_(".WEB_ROOT.$__name.").");
}

function _fcopy_($__source,$__target){
  settype($__source,"string");
  settype($__target,"string");

  clearstatcache();

  if(!file_exists(WEB_ROOT.$__source))
    return;
  elseif(copy(WEB_ROOT.$__source, WEB_ROOT.$__target)){
    clearstatcache();

    if(file_exists(WEB_ROOT.$__target))
      if(file_get_contents(WEB_ROOT.$__target) === file_get_contents(WEB_ROOT.$__source))
        return;
  }

  _fdel_($__target);
  exit("System Error: _fcopy_(".WEB_ROOT.$__source.",".WEB_ROOT.$__target.").");
}

function _fcreate_($__name,$__content){
  settype($__name,"string");
  settype($__content,"string");

  if(($__fid=fopen(WEB_ROOT.$__name,"wb"))!==FALSE){
    if(fwrite($__fid,$__content)===strlen($__content)){
      fflush($__fid);
      fclose($__fid);
      clearstatcache();

    if(file_exists(WEB_ROOT.$__name))
      if(file_get_contents(WEB_ROOT.$__name)===$__content)
        return;
    }

    @fclose($__fid);
  }

  _fdel_($__name);
  exit("System Error: _fcreate_(".WEB_ROOT.$__name.",...).");
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

  if(!is_dir(WEB_ROOT.$__dir))
    return $__ls;
  elseif(($__dir_id=opendir(WEB_ROOT.$__dir))!==FALSE){
    while(($__file=readdir($__dir_id))!==FALSE)
    
    if(preg_match("/^".$__regexp."$/",$__file))
      array_push($__ls,$__file);

    closedir($__dir_id);
    sort($__ls,SORT_STRING);
    return $__ls;
  }

  exit("System Error: _ls_(".WEB_ROOT.$__dir.",".$__pattern.").");
}

function _filename_($__template,$__replace){
  settype($__template,"string");
  settype($__replace,"string");

  return preg_replace("/\\x2A/",$__replace,$__template);
}

function _filesize_($__name){
  settype($__name,"string");

  clearstatcache();
  return((file_exists(WEB_ROOT.$__name))?round(filesize(WEB_ROOT.$__name)/1024,1):0);
}

############################################################################################

?>