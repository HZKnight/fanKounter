<?php 
/* 
 * lan.inc.php
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
 * Copyright (C) 2018 Luca Liscio
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
 * Modulo importato per la definizione di stringhe di testo in inglese.
 * 
 *  @author  lucliscio <lucliscio@h0model.org>
 *  @version v 5.0.1
 *  @copyright Copyright 2018 Luca Liscio
 *  @copyright Copyright 2003 Fanatiko 
 *  @license http://www.gnu.org/licenses/agpl-3.0.html GNU/AGPL3
 *   
 *  @package fanKounter
 *  @filesource
 */

############################################################################################
# STRINGHE DI TESTO (en)
############################################################################################

define("CHARSET","iso-8859-1");

// Contatore grafico
define("LAN_TODAY","TODAY");
define("LAN_TOTAL","TOTAL");

// Calendario
define("LAN_MONTHS","January,February,March,April,May,June,July,August,September,October,November,December");
define("LAN_DAYS","Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday");

// Titoli della pagina
define("LAN_TITLE1","fanKounter :: Statistics");
define("LAN_TITLE2","fanKounter :: Statistics for «%s»");

// Testi della maschera di accesso
define("LAN_MASK1","Select a counter:");
define("LAN_MASK2","Enter password:");

// Bottoni del menù
define("LAN_MENU1","SUMMARY");
define("LAN_MENU2","LAST ACCESSES");
define("LAN_MENU3","RENTS");
define("LAN_MENU4","ORIGINS");
define("LAN_MENU5","USERS");
define("LAN_MENU6","SCHEDULE");
define("LAN_MENU7","EXIT");

// Altre voci generiche
define("LAN_HEADER","Statistiche per «[count]%1\$s[/count]» in data [date]%2\$s[/date] ore [hi]%3\$s[/hi]");
define("LAN_TOP","- TOP -");

// Altre voci comuni
define("LAN_UNKNOWN_IP","(unknown)");
define("LAN_UNKNOWN_COUNTRY","(unknown)");
define("LAN_UNKNOWN_BROWSER","(unknown)");
define("LAN_UNKNOWN_OS","(unknown)");
define("LAN_UNKNOWN_PROVIDER","(unknown)");
define("LAN_UNKNOWN_LOCATION","(direct counter)");
define("LAN_UNKNOWN_REFERRER","(direct access)");
define("LAN_EMPTY","no data");
define("LAN_OTHER","(other)");

// Pannello del sommario
define("LAN001","Access Summary");
define("LAN002","[hi]Today[/hi] had so far [count]%s[/count] accesses.");
define("LAN003","[hi]Yesterday[/hi] there was a total of [count]%s[/count] accesses.");
define("LAN004","[hi]This month[/hi] had so far [count]%s[/count] accesses.");
define("LAN005","[hi]Last month[/hi] had a total of [count]%s[/count] accesses.");
define("LAN006","[hi]This year[/hi] had so far [count]%s[/count] accesses.");
define("LAN007","[hi]Last year[/hi] there was a total of [count]%s[/count] accesses.");
define("LAN008","The total of [hi]counted accesses[/hi] is [count]%s[/count].");
define("LAN009","The average of [hi]accesses per day[/hi] is [count]%s[/count].");
define("LAN010","Detection Notes");
define("LAN011","You are counting [hi]all visits[/hi], without excluding reloads and re-entries.");
define("LAN012","You are counting [hi]1 visitor[/hi] every [count]%1\$s[/count] hours, [count]%2\$s[/count]minutes.") ;
define("LAN013","The time of a visit is deemed to be concluded without delay at [hi]midnight[/hi].");
define("LAN014","Each visitor is counted [hi]1 once[/hi] for all pages of the site he visits.");
define("LAN015","Each visitor is counted in [hi]each[/hi] of the pages of the site he visits.");
define("LAN016","Curiosity");
define("LAN017","The daily access record is [count]%1\$s[/count], which occurred last time on [date]%2\$s[/date].");
define("LAN018","The monthly access record is [count]%1\$s[/count], the last time the month of [hi]%2\$s[/hi] occurred.");
define("LAN019","Information");
define("LAN020","I am reading the configuration from the file [hi]%s[/hi].");
define("LAN021","I am reading data from file [hi]%1\$s[/hi] ([hi]%2\$s[/hi] kBytes).");
define("LAN022","The counter started on [date]%1\$s[/date] from [count]%2\$s[/count].");
define("LAN023","Counter is active from [hi]%1\$s[/hi] days and marks [count]%2\$s[/count] accesses.");
define("LAN024","System Notes");
define("LAN025","Language version [hi]PHP[/hi]: [count]%s[/count]");
define("LAN026","Library version [hi]GD[/hi]: [count]%s[/count]");
define("LAN027","Library version [hi]GD[/hi]: not available");
define("LAN028","Script version [hi]fanKounter[/hi]: [count]%s[/count]");

// Pannello degli ultimi accessi
define("LAN101","Detail of the Last [count]%s[/count] Access");
define("LAN102","Access");
define("LAN103","State");
define("LAN104","IP address");
define("LAN105","Browser");
define("LAN106","Operating System");
define("LAN107","Location");
define("LAN108","Origin");

// Pannello delle locazioni
define("LAN201","Total Access for [hi]Visited  Pages[/hi]");
define("LAN202","Page");
define("LAN203","Graph (hits)");
define("LAN204","%%");
define("LAN205","Total Access for [hi]Sites Visited[/hi]");
define("LAN206","Website");
define("LAN207","Graph (hits)");
define("LAN208","%%");

// Pannello delle provenienze
define("LAN301","Access by [hi]Pages of Origin[/hi]");
define("LAN302","Page");
define("LAN303","Graph (hits)");
define("LAN304","%%");
define("LAN305","Access by [hi]Domains of Provenance[/hi]");
define("LAN306","Domain");
define("LAN307","Graph (hits)");
define("LAN308","%%");
define("LAN309","Provenances from [hi]Search Engines[/hi]");
define("LAN310","Search Engine");
define("LAN311","Graph (hits)");
define("LAN312","%%");
define("LAN313","[hi]Keywords[/hi]searched in Search Engines");
define("LAN314","key");
define("LAN315","Graph (hits)");
define("LAN316","%%");

// Pannello degli utenti
define("LAN401","Total Access for [hi]Browser[/hi]");
define("LAN402","Browser");
define("LAN403","Graph (hits)");
define("LAN404","%%");
define("LAN405","Total Access for [hi]Operating System[/hi]");
define("LAN406","Operating System");
define("LAN407","Graph (hits)");
define("LAN408","%%");
define("LAN409","Total Access for [hi]Provider[/hi]");
define("LAN410","Provider");
define("LAN411","Graph (hits)");
define("LAN412","%%");
define("LAN413","Total Access for [hi]State[/hi]");
define("LAN414","State");
define("LAN415","Graph (hits)");
define("LAN416","%%");

// Pannello del calendario
define("LAN501","Report of [hi]Last 31 Days[/hi]");
define("LAN502","Day");
define("LAN503","Graph (hits)");
define("LAN504","%%");
define("LAN505","Report of [hi]Last 12 Months[/hi]");
define("LAN506","Month");
define("LAN507","Graph (hits)");
define("LAN508","%%");
define("LAN509","Total Access for [hi]Year[/hi]");
define("LAN510","Year");
define("LAN511","Graph (hits)");
define("LAN512","%%");
define("LAN513","Total Access for [hi]Day of the Week[/hi]");
define("LAN514","Day");
define("LAN515","Graph (hits)");
define("LAN516","%%");
define("LAN517","Total Access for [hi]Time of Day[/hi]");
define("LAN518","Time band");
define("LAN519","Graph (hits)");
define("LAN520","%%");

############################################################################################

?>