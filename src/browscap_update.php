<?php
    /* 
     * browscap_update.php
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
     * Copyright (C)2022 HZKnight
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
     * Browscap updater
     * 
     *  @author  lucliscio <lucliscio@h0model.org>
     *  @version v 1.0
     *  @copyright Copyright 2022 HZKnight
     *  @license http://www.gnu.org/licenses/agpl-3.0.html GNU/AGPL3
     *   
     *  @package fanKounter
     *  @filesource
     */

    require_once 'libs/Browscap.php';
    use phpbrowscap\Browscap;
    
    ini_set('memory_limit', '-1');

    echo "<h1>Browscap Updater <small>Ver. 1.0</small></h1>";
    echo "<h2>Step 1 - Cleaning cache ....</h2>";

    foreach (new DirectoryIterator('temp/cache') as $fileInfo) {
        if(!$fileInfo->isDot()) {
            echo $fileInfo->getPathname()."...";
            unlink($fileInfo->getPathname());
            echo "DELETED"."<br>";
        }
    }

    echo "<h2>Step 2 - Updating browscap ....</h2>";
    $browscap = new Browscap('temp/cache');
    $browscap->updateCache();

    echo "END";
?>
