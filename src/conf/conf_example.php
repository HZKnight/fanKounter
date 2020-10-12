<?php 
/* 
 * conf_example.php
 *                                       __       HZKnight free PHP Scripts    _    vs 5.1
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
 * Esempio di configurazione per un contatore.
 *
 * A partire da questo file è possibile creare una nuova istanza di contatore.
 *
 * - Modificare in base alle proprie preferenze le seguenti variabili. Queste, tuttavia, sono
 *   già configurate correttamente per un utilizzo standard.
 *
 * - Salvare questo file con un nome della forma 'config_ID.php', dove ID sarà il suo
 *   identificatore, e porlo sul server nella sottocartella del fanKounter di nome 'conf'.
 *
 * Un ID può essere costituito solamente da caratteri alfanumerici, può avere qualsiasi
 * lunghezza, ed è case-sensitive, ossia "test" e "TesT" identificheranno normalmente due
 * diverse istanze di contatore, ma questo dipende dal sistema operativo in uso.
 *
 * Se, ad esempio, si decide di identificare questo contatore con "test1", allora salvare
 * il file con il nome 'conf_test1.php' (senza apici).
 * 
 *  @author  lucliscio <lucliscio@h0model.org>
 *  @version v 5.1
 *  @copyright Copyright 2020 HZKnight
 *  @copyright Copyright 2003 Fanatiko 
 *  @license http://www.gnu.org/licenses/agpl-3.0.html GNU/AGPL3
 *   
 *  @package fanKounter
 *  @filesource
 * 
 */

############################################################################################
# IMPOSTAZIONI DEL CONTATORE
############################################################################################

$cnf__start_count         = 0;
$cnf__mtime_unique_accs   = 30;
$cnf__expire_on_midnight  = FALSE;
$cnf__count_per_pages     = FALSE;
$cnf__licit_domains_list  = array();
$cnf__IPmasks_ignore_list = array();
$cnf__htime_sync_server   = 0;
$cnf__last_entries        = 15;

############################################################################################
# IMPOSTAZIONI DEL VISUALIZZATORE
############################################################################################

$cnf__userpass       = md5("admin");
$cnf__passwd_protect = TRUE;
$cnf__limit_view     = 15;
$cnf__lang = "it" //it => italiano, en => inglese

############################################################################################

?>