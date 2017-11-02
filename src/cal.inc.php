<?php /* cal.inc.php
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
 Modulo importato per la gestione del calendario.

      */

############################################################################################
# DEFINIZIONE DI CLASSE
############################################################################################

class Calendar{
 var $__year;

 function Calendar(){
  $this->__year=array();
  return;
 }

 function _make_year_($__year){
  settype($__year,"string");

  if(!array_key_exists($__year,$this->__year)){
   $this->__year[$__year]=array();

   for($__month=0;$__month<12;$__month++)
    if(checkdate(1+$__month,31,$__year))
     $this->__year[$__year][$__month]=array_fill(0,31,0);
    elseif(checkdate(1+$__month,30,$__year))
     $this->__year[$__year][$__month]=array_fill(0,30,0);
    elseif(checkdate(1+$__month,29,$__year))
     $this->__year[$__year][$__month]=array_fill(0,29,0);
    else
     $this->__year[$__year][$__month]=array_fill(0,28,0);

   ksort($this->__year[$__year],SORT_NUMERIC);
   ksort($this->__year,SORT_NUMERIC);
  }

  return;
 }

 function _set_hit_($__timestamp){
  settype($__timestamp,"integer");

  $__year=date("Y",$__timestamp);
  $__month=date("n",$__timestamp);
  $__date=date("j",$__timestamp);

  settype($__month,"integer");
  settype($__date,"integer");

  if(checkdate($__month,$__date,$__year)){
   $this->_make_year_($__year);
   $this->__year[$__year][$__month-1][$__date-1]++;
   return TRUE;
  }

  return FALSE;
 }

 function _get_hits_($__timestamp,$__type){
  settype($__timestamp,"integer");
  settype($__type,"string");

  $__year=date("Y",$__timestamp);
  $__month=date("n",$__timestamp);
  $__date=date("j",$__timestamp);

  settype($__month,"integer");
  settype($__date,"integer");

  if(array_key_exists($__year,$this->__year))
   switch(strtolower($__type{0})){
    case "d":
     if(array_key_exists($__month-1,$this->__year[$__year]))
      if(array_key_exists($__date-1,$this->__year[$__year][$__month-1]))
       return $this->__year[$__year][$__month-1][$__date-1];
     break;
    case "m":
     if(array_key_exists($__month-1,$this->__year[$__year]))
      return array_sum($this->__year[$__year][$__month-1]);
     break;
    case "y":
     return array_sum(array_map("array_sum",$this->__year[$__year]));
   }

  return 0;
 }

 function _get_years_(){
  $__years=array();

  foreach($this->__year as $__year_k=>$__month_a)
   $__years[$__year_k]=array_sum(array_map("array_sum",$__month_a));

  return $__years;
 }

 function _max_hits_in_date_(){
  global $aux__now;

  $__max=array("timestamp"=>$aux__now,"hits"=>0);

  foreach($this->__year as $__year_k=>$__month_a)
   foreach($__month_a as $__month_k=>$__date_a)
    foreach($__date_a as $__date_k=>$__hits)
     if($__hits>=$__max["hits"]){
      $__max["timestamp"]=mktime(12,00,00,1+$__month_k,1+$__date_k,$__year_k);
      $__max["hits"]=$__hits;
     }

  return $__max;
 }

 function _max_hits_in_month_(){
  global $aux__now;

  $__max=array("timestamp"=>$aux__now,"hits"=>0);

  foreach($this->__year as $__year_k=>$__month_a)
   foreach($__month_a as $__month_k=>$__date_a)
    if(($__hits=array_sum($__date_a))>=$__max["hits"]){
     $__max["timestamp"]=mktime(12,00,00,1+$__month_k,1,$__year_k);
     $__max["hits"]=$__hits;
    }

  return $__max;
 }

 function _update_($__celendar){
  settype($__calendar,"array");

  $this->__year=$__celendar;
  return;
 }

 function _safe_($__var_name){
  settype($__var_name,"string");

  $__safe="";

  foreach($this->__year as $__year=>$__month){
   $__safe.="\$".$__var_name."[\"".$__year."\"]=array(";

   for($__m=0,$__fm=TRUE;$__m<count($__month);$__m++){
    $__safe.=(($__fm)?"":",")."array(".implode(",",$__month[$__m]).")";
    $__fm=FALSE;
   }

   $__safe.=");".EOL;
  }

  return $__safe;
 }
}

############################################################################################

?>