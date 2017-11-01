<?php /* url.inc.php
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
 Modulo importato per la gestione di URL, referrer e motori di ricerca.

      */

############################################################################################
# DEFINIZIONE DI CLASSE
############################################################################################

class URL{
 var $__url_v;

 function URL($__url){
  settype($__url,"string");

  $__url_v=array("prot"=>"","host"=>"","port"=>"","path"=>"","page"=>"","para"=>"");

  do
   $__url=urldecode($__url);
  while(preg_match("/%[a-f\d]{2}/i",$__url));

  $__url=(get_magic_quotes_gpc())?stripslashes($__url):$__url;
  $__url=preg_replace("/[\\x00-\x1F]/","",$__url);
  $__url=preg_replace("/\\x5C/","/",$__url);
  $__url=trim($__url);

  if(preg_match("/^(http:\/\/|https:\/\/|ftp:\/\/)/i",$__url,$__res)){
   $__url=trim(preg_replace("/^".preg_quote($__res[1],"/")."/","",$__url));
   $__url_v["prot"]=strtolower($__res[1]);
  }
  else{
   $this->__url_v=FALSE;
   return;
  }

  if(preg_match("/^(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(:|\/|$)/",$__url,$__res)){
   $__url=preg_replace("/^".preg_quote($__res[1],"/")."/","",$__url);
   $__url_v["host"]=$__res[1];
  }
  elseif(preg_match("/^(([a-z\d]\.|[a-z\d][a-z\d\-]*[a-z\d]\.)*)(([a-z\d][a-z\d\-]*[a-z\d])\.[a-z]{2,4})(:|\/|$)/i",$__url,$__res)){
   $__url=preg_replace("/^".preg_quote($__res[1].$__res[3],"/")."/","",$__url);
   $__url_v["host"]=strtolower((($__res[1]!=="")?$__res[1]:"www.").$__res[3]);
  }
  else{
   $this->__url_v=FALSE;
   return;
  }

  if(preg_match("/^(:\d*|)(\/|$)/",$__url,$__res)){
   $__url=preg_replace("/^".preg_quote($__res[1],"/")."/","",$__url);
   $__url_v["port"]=(($__res[1]===":")||($__res[1]===":80"))?"":$__res[1];
  }
  else{
   $this->__url_v=FALSE;
   return;
  }

  if(preg_match("/^[^?]*(\?.*)$/",$__url,$__res)){
   $__url=trim(preg_replace("/".preg_quote($__res[1],"/")."$/","",$__url));
   $__url_v["para"]=$__res[1];
  }

  if(preg_match("/^.*(\/[^\/]+\.[^\/\s.]+)$/",$__url,$__res)){
   $__url=trim(preg_replace("/".preg_quote($__res[1],"/")."$/","",$__url));
   $__url_v["page"]="/".trim(substr($__res[1],1));
  }

  if(preg_match_all("/(\/[^\/]*)/",$__url,$__res)){
   $__url=preg_replace("/".preg_quote(implode("",$__res[1]),"/")."/","",$__url);

   foreach($__res[1] as $__index=>$__path)
    $__res[1][$__index]="/".trim(substr($__path,1),"\x5C\x20");

   for($__count=0;$__count<count($__res[1]);$__count++)
    switch($__res[1][$__count]){
     case "/..":
      if($__count>0)
       unset($__res[1][$__count-1]);
     case "/":
     case "/.":
      unset($__res[1][$__count]);
      $__res[1]=array_values($__res[1]);
      $__count=-1;
    }

   $__url_v["path"]=implode("",$__res[1]);
  }

  $this->__url_v=($__url==="")?$__url_v:FALSE;
  return;
 }

 function _normalize_(){
  $__page=(preg_match("/^\/index\./i",$this->__url_v["page"]))?"":$this->__url_v["page"];
  return ($this->__url_v!==FALSE)?urlencode($this->__url_v["prot"].$this->__url_v["host"].$this->__url_v["port"].$this->__url_v["path"].$__page):FALSE;
 }
}

############################################################################################
# DEFINIZIONE DI SOTTOCLASSE
############################################################################################

class Referrer extends URL{
 var $__engine_name;
 var $__engine_keys_v;

 function Referrer($__url){
  settype($__url,"string");

  global $inf__engine,$inf__keyban;

  parent::URL($__url);

  if($this->__url_v!==FALSE)
   foreach($inf__engine as $__name=>$__param)
    if(preg_match("/\.(".preg_quote($__name,"/")."\..+)$/i",$this->__url_v["host"],$__res)){
     $this->__engine_name=strtolower($__res[1]);

     if(preg_match("/[?&]".$__param."=([^&]+)(&|$)/i",$this->__url_v["para"],$__res)){
      $this->__engine_keys_v=explode(" ",strtolower(trim(preg_replace("/\s{2,}/"," ",preg_replace("/[^\w\d\s]/"," ",$__res[2])))));

      foreach($this->__engine_keys_v as $__index=>$__enkey)
       if(strlen($__enkey)<KEYLEN)
        unset($this->__engine_keys_v[$__index]);

      $this->__engine_keys_v=array_diff(array_unique($this->__engine_keys_v),$inf__keyban);
      sort($this->__engine_keys_v,SORT_STRING);

      if(count($this->__engine_keys_v)>0)
       return;
     }
    }

  $this->__engine_name=FALSE;
  $this->__engine_keys_v=FALSE;
  return;
 }

 function _is_engine_(){
  return ((($this->__engine_name===FALSE)||($this->__engine_keys_v===FALSE))?FALSE:TRUE);
 }

 function _get_engine_name_(){
  return (($this->_is_engine_())?$this->__engine_name:FALSE);
 }

 function _get_engine_keys_(){
  return (($this->_is_engine_())?$this->__engine_keys_v:FALSE);
 }
}

############################################################################################

?>