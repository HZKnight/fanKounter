<?php /* conf_example.php
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
 Esempio di configurazione per un contatore.

 A partire da questo file � possibile creare una nuova istanza di contatore.

 * Modificare in base alle proprie preferenze le seguenti variabili. Queste, tuttavia, sono
   gi� configurate correttamente per un utilizzo standard.

 * Salvare questo file con un nome della forma 'config_ID.php', dove ID sar� il suo
   identificatore, e porlo sul server in una sottocartella del fanKounter di nome 'conf'.

   Un ID pu� essere costituito solamente da caratteri alfanumerici, pu� avere qualsiasi
   lunghezza, ed � case-sensitive, ossia "test" e "TesT" identificheranno normalmente due
   diverse istanze di contatore, ma questo dipende dal sistema operativo in uso.

   Se, ad esempio, si decide di identificare questo contatore con "test1", allora salvare
   il file con il nome 'conf_test1.php' (senza apici).

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

############################################################################################

?>