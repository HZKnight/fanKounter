<?php
/* 
 * cnf.inc.php
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
 * Modulo importato per la configurazione globale dello script.
 *
 * ATTENZIONE - UNA MODIFICA ERRATA DI QUESTO FILE PUO' COMPROMETTERE IL FUNZIONAMENTO DEI
 * CONTATORI. MODIFICARE CON CAUTELA E SOLO SE SI SA ESATTAMENTE COSA SI STA FACENDO.
 *
 * LE UNICHE VARIABILI CHE DOVREBBERO ESSERE MODIFICATE IN QUESTO FILE SONO QUELLE CHE SI
 * TROVANO NELL'ULTIMO PARAGRAFO SULLA 'CONFIGURAZIONE DEFAULT PER UN CONTATORE'.
 * 
 *  @author  lucliscio <lucliscio@h0model.org>
 *  @version v 5.1
 *  @copyright Copyright 2020 HZKinght
 *  @copyright Copyright 2003 Fanatiko 
 *  @license http://www.gnu.org/licenses/agpl-3.0.html GNU/AGPL3
 *   
 *  @package fanKounter
 *  @filesource
 *
 */

############################################################################################
# IMPOSTAZIONI DI ESECUZIONE
############################################################################################
// Nasconde qualsiasi messaggio di errore o di avviso run-time
error_reporting(0);

// Prefisso per gli input ottenuti mediante get, post, cookie
//deprecato - import_request_variables("gpc","par__");
$__inputs = array_merge($_COOKIE,$_REQUEST); 
extract($__inputs, EXTR_PREFIX_ALL | EXTR_REFS, 'par_');

############################################################################################
# COSTANTI GLOBALI
############################################################################################
// Memorizza il timestamp del server
define("NOW", time());

// Carattere di fine linea per i file: Win usa "\r\n", Unix usa "\n", Mac usa "\r"
define("EOL", "\r\n");

// Lingua di default: it => italiano, en => inglese
define("LANG", "it");

############################################################################################
# IMPOSTAZIONI DI INTEGRITA'
############################################################################################
// Attiva o disattiva la condivisione dei file ottenuta mediante funzione 'flock()'
define("FLOCK", TRUE);

############################################################################################
# IMPOSTAZIONI DI PERFORMANCE
############################################################################################
// Esegue o meno la traduzione di un IP al rispettivo hostname
define("HOSTNAME", TRUE);

// Ricorrenza di tempo (secondi) in cui effettuare lo sfoltimento delle strutture dati
define("CUTTIME", 60 * 60 * 24 * 180);

// Limite max di elementi per le strutture dati che possono crescere in modo spropositato
define("CUTSIZE", 150);

############################################################################################
# CARTELLE E FILE
############################################################################################

define("CONFIG_FOLDER", "conf/");
define("DATA_FOLDER", "data/");
define("BACKUP_FOLDER", "back/");
define("TEMP_FOLDER", "temp/");

define("CONFIG_FILES", "conf_*.php");
define("DATA_FILES", "data_*.php");
define("ACCESS_FILES", "accs_*.dat");
define("FLOCK_FILES", "lock_*.tmp");

############################################################################################
# CREDITS
############################################################################################

define("HOMEPAGE", "https://fankounter.hzknight.org/");
define("EMAIL", "lucliscio@h0model.org");
define("VERSION", "5.1.0-unstable.7");

############################################################################################
# CONFIGURAZIONE DEFAULT PER UN CONTATORE
############################################################################################
// Validatore per la creazione di nuovi contatori
define("MAKE_PATHS", "");

// Impostazioni multiutenza
$cnf__username = "admin";
$cnf__usermail = "user@email.com";
$cnf__userpass = md5("admin");

// Impostazioni del contatore
$cnf__start_count = 0;
$cnf__mtime_unique_accs = 30;
$cnf__expire_on_midnight = FALSE;
$cnf__count_per_pages = FALSE;
$cnf__licit_domains_list = array();
$cnf__IPmasks_ignore_list = array();
$cnf__htime_sync_server = 0;
$cnf__last_entries = 15;

// Impostazioni del visualizzatore
$cnf__passwd_protect = FALSE;
$cnf__limit_view = 15;
$cnf__lang = "it" //it => italiano, en => inglese

############################################################################################

?>