<?php 
/* 
 * lan.inc.php
 *                                       __                      PHP Script    _    vs 5.1
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
 * Copyright (C) 2020 Luca Liscio
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
 * Modulo importato per la definizione di stringhe di testo in italiano.
 * 
 *  @author  lucliscio <lucliscio@h0model.org>
 *  @version v 5.0.3
 *  @copyright Copyright 2020 Luca Liscio
 *  @copyright Copyright 2003 Fanatiko 
 *  @license http://www.gnu.org/licenses/agpl-3.0.html GNU/AGPL3
 *   
 *  @package fanKounter
 *  @filesource
 */

############################################################################################
# STRINGHE DI TESTO (it)
############################################################################################

define("CHARSET","iso-8859-1");

// Contatore grafico
define("LAN_TODAY","OGGI");
define("LAN_TOTAL","TOTALE");

// Calendario
define("LAN_MONTHS","Gennaio,Febbraio,Marzo,Aprile,Maggio,Giugno,Luglio,Agosto,Settembre,Ottobre,Novembre,Dicembre");
define("LAN_DAYS","Luned&igrave;,Marted&igrave;,Mercoled&igrave;,Gioved&igrave;,Venerd&igrave;,Sabato,Domenica");

// Titoli della pagina
define("LAN_TITLE1","fanKounter :: Statistiche");
define("LAN_TITLE2","fanKounter :: Statistiche per «%s»");

// Testi della maschera di accesso
define("LAN_MASK1","Seleziona un contatore:");
define("LAN_MASK2","Inserisci la password:");

// Bottoni del menù
define("LAN_MENU1","SOMMARIO");
define("LAN_MENU2","ULTIMI ACCESSI");
define("LAN_MENU3","LOCAZIONI");
define("LAN_MENU4","PROVENIENZE");
define("LAN_MENU5","UTENTI");
define("LAN_MENU6","CALENDARIO");
define("LAN_MENU7","ESCI");

// Altre voci generiche
define("LAN_HEADER","Statistiche per «[count]%1\$s[/count]» in data [date]%2\$s[/date] ore [hi]%3\$s[/hi]");
define("LAN_TOP","- TOP -");

// Altre voci comuni
define("LAN_UNKNOWN_IP","(sconosciuto)");
define("LAN_UNKNOWN_COUNTRY","(sconosciuto)");
define("LAN_UNKNOWN_BROWSER","(sconosciuto)");
define("LAN_UNKNOWN_OS","(sconosciuto)");
define("LAN_UNKNOWN_PROVIDER","(sconosciuto)");
define("LAN_UNKNOWN_LOCATION","(contatore diretto)");
define("LAN_UNKNOWN_REFERRER","(accesso diretto)");
define("LAN_EMPTY","nessun dato");
define("LAN_OTHER","(altro)");

// Pannello del sommario
define("LAN001","Riepilogo Accessi");
define("LAN002","[hi]Oggi[/hi] si sono avuti finora [count]%s[/count] accessi.");
define("LAN003","[hi]Ieri[/hi] si sono avuti un totale di [count]%s[/count] accessi.");
define("LAN004","[hi]Questo mese[/hi] si sono avuti finora [count]%s[/count] accessi.");
define("LAN005","Lo [hi]scorso mese[/hi] si sono avuti un totale di [count]%s[/count] accessi.");
define("LAN006","[hi]Quest'anno[/hi] si sono avuti finora [count]%s[/count] accessi.");
define("LAN007","Lo [hi]scorso anno[/hi] si sono avuti un totale di [count]%s[/count] accessi.");
define("LAN008","Il totale degli [hi]accessi conteggiati[/hi] è [count]%s[/count].");
define("LAN009","La media degli [hi]accessi al giorno[/hi] è [count]%s[/count].");
define("LAN010","Note di Rilevazione");
define("LAN011","Si stanno conteggiando [hi]tutte le visite[/hi], senza escludere reloads e rientri.");
define("LAN012","Si sta conteggiando [hi]1 visitatore[/hi] ogni [count]%1\$s[/count] ore, [count]%2\$s[/count] minuti.");
define("LAN013","Il tempo di una visita si ritiene concluso improrogabilmente alla [hi]mezzanotte[/hi].");
define("LAN014","Ogni visitatore viene conteggiato [hi]1 sola volta[/hi] per tutte le pagine del sito che visita.");
define("LAN015","Ogni visitatore viene conteggiato in [hi]ognuna[/hi] delle pagine del sito che visita.");
define("LAN016","Curiosità");
define("LAN017","Il record di accessi giornalieri è [count]%1\$s[/count], accaduto l'ultima volta il giorno [date]%2\$s[/date].");
define("LAN018","Il record di accessi mensili è [count]%1\$s[/count], accaduto l'ultima volta il mese di [hi]%2\$s[/hi].");
define("LAN019","Informazioni");
define("LAN020","Sto leggendo la configurazione dal file [hi]%s[/hi].");
define("LAN021","Sto leggendo i dati dal file [hi]%1\$s[/hi] ([hi]%2\$s[/hi] kBytes).");
define("LAN022","Il contatore è partito il giorno [date]%1\$s[/date] da [count]%2\$s[/count].");
define("LAN023","Il contatore è attivo da [hi]%1\$s[/hi] giorni e segna [count]%2\$s[/count] accessi.");
define("LAN024","Note di Sistema");
define("LAN025","Versione del linguaggio [hi]PHP[/hi]: [count]%s[/count]");
define("LAN026","Versione della libreria [hi]GD[/hi]: [count]%s[/count]");
define("LAN027","Versione della libreria [hi]GD[/hi]: non disponibile");
define("LAN028","Versione dello script [hi]fanKounter[/hi]: [count]%s[/count]");
define("LAN029","Versione della libreria [hi]Browscap[/hi]: [count]%s[/count]");
define("LAN030","Versione del database [hi]Browscap[/hi]: [count]%s[/count]");

// Pannello degli ultimi accessi
define("LAN101","Dettaglio degli Ultimi [count]%s[/count] Accessi");
define("LAN102","Accesso");
define("LAN103","Stato");
define("LAN104","Indirizzo IP");
define("LAN105","Browser");
define("LAN106","Sistema Operativo");
define("LAN107","Locazione");
define("LAN108","Provenienza");

// Pannello delle locazioni
define("LAN201","Totale Accessi per [hi]Pagine Visitate[/hi]");
define("LAN202","Pagina");
define("LAN203","Grafico (hits)");
define("LAN204","%%");
define("LAN205","Totale Accessi per [hi]Siti Visitati[/hi]");
define("LAN206","Sito");
define("LAN207","Grafico (hits)");
define("LAN208","%%");

// Pannello delle provenienze
define("LAN301","Accessi per [hi]Pagine di Provenienza[/hi]");
define("LAN302","Pagina");
define("LAN303","Grafico (hits)");
define("LAN304","%%");
define("LAN305","Accessi per [hi]Domini di Provenienza[/hi]");
define("LAN306","Dominio");
define("LAN307","Grafico (hits)");
define("LAN308","%%");
define("LAN309","Provenienze dai [hi]Motori di Ricerca[/hi]");
define("LAN310","Motore di Ricerca");
define("LAN311","Grafico (hits)");
define("LAN312","%%");
define("LAN313","[hi]Parole Chiave[/hi] ricercate nei Motori di Ricerca");
define("LAN314","Chiave");
define("LAN315","Grafico (hits)");
define("LAN316","%%");

// Pannello degli utenti
define("LAN401","Totale Accessi per [hi]Browser[/hi]");
define("LAN402","Browser");
define("LAN403","Grafico (hits)");
define("LAN404","%%");
define("LAN405","Totale Accessi per [hi]Sistema Operativo[/hi]");
define("LAN406","Sistema Operativo");
define("LAN407","Grafico (hits)");
define("LAN408","%%");
define("LAN409","Totale Accessi per [hi]Provider[/hi]");
define("LAN410","Provider");
define("LAN411","Grafico (hits)");
define("LAN412","%%");
define("LAN413","Totale Accessi per [hi]Stato[/hi]");
define("LAN414","Stato");
define("LAN415","Grafico (hits)");
define("LAN416","%%");

// Pannello del calendario
define("LAN501","Resoconto degli [hi]Ultimi 31 Giorni[/hi]");
define("LAN502","Giorno");
define("LAN503","Grafico (hits)");
define("LAN504","%%");
define("LAN505","Resoconto degli [hi]Ultimi 12 Mesi[/hi]");
define("LAN506","Mese");
define("LAN507","Grafico (hits)");
define("LAN508","%%");
define("LAN509","Totale Accessi per [hi]Anno[/hi]");
define("LAN510","Anno");
define("LAN511","Grafico (hits)");
define("LAN512","%%");
define("LAN513","Totale Accessi per [hi]Giorno della Settimana[/hi]");
define("LAN514","Giorno");
define("LAN515","Grafico (hits)");
define("LAN516","%%");
define("LAN517","Totale Accessi per [hi]Ora del Giorno[/hi]");
define("LAN518","Fascia Oraria");
define("LAN519","Grafico (hits)");
define("LAN520","%%");

############################################################################################

?>