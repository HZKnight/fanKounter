![#fanKounter](https://fankounter.hzknight.org/assets/images/fankounter2.0.png) 

[![Release](https://img.shields.io/github/release/lucliscio/fanKounter.svg)](https://github.com/lucliscio/fanKounter/releases/latest) 
[![Pre-release](https://img.shields.io/github/tag-pre/lucliscio/fankounter.svg?label=pre-release)](https://github.com/lucliscio/fanKounter/releases/tag/5.1-unstable.8)
![Licence](https://img.shields.io/github/license/lucliscio/fanKounter.svg)
![Issue](https://img.shields.io/github/issues/lucliscio/fanKounter.svg)
[![Code Climate](https://codeclimate.com/github/lucliscio/fanKounter/badges/gpa.svg)](https://codeclimate.com/github/lucliscio/fanKounter)
[![Open Source Love](https://badges.frapsoft.com/os/v1/open-source.svg?v=103)](https://github.com/ellerbrock/open-source-badges/)

- **fanKounter code** ©2021 by HZKnight is licensed under [AGPL 3.0](https://www.gnu.org/licenses/agpl-3.0.html)
- **fanKounter User Guide and all related documentation** ©2021 by HZKnight is licensed under [CC BY 4.0](https://creativecommons.org/licenses/by/4.0/?ref=chooser-v1) 

## Descrizione
fanKounter è uno script in PHP gratuito, distribuito sotto licenza GNU AGPL, per creare e gestire una quantità indefinita di contatori (grafici, testuali o invisibili) di accessi alle pagine WEB. Ogni contatore tiene traccia dei visitatori e fornisce completi report statistici, tra cui referrer di provenienza, compresi i motori di ricerca. Non necessita di database ma memorizza i dati in file in maniera efficace ed occupando poco spazio fisico. E’ facile da configurare e pienamente personalizzabile. Si può programmare la modalità con cui i reports devono essere acquisiti, definire i tempi di una visita, escludere IP e maschere di IP, convalidare gli accessi. Ogni istanza di contatore che si crea funziona in modo indipendente dalle altre. La creazione di una nuova istanza di contatore può avvenire in modo automatico, non appena se ne faccia richiesta da una pagina Web del sito ritenuta lecita. Si portà, ad esempio, creare una nuova pagina del sito e monitorarne le visite mediante un nuovo contatore che verrà creato e configurato automaticamente dal fanKounter.

***Importante**: A causa delle norme sulla privacy i motori di ricerca non trasmettono più le parole chiave usate dagli utenti per tanto non è più possibile tracciarle* 

## Caratteristiche
- Non richiede database
- Supporto per multiple istanze di contatori
- Istanziamento automatico dei contatori
- Tripla modalità di inclusione: grafica, solo testo e nascosta
- Programmazione del rilevamento
- Convalida di chiamata ed esclusione di IP
- Report statistici completi sui visitatori
- Pruning automatico dei file di dati

## Requisiti
Il fanKounter non ha bisogno di requisiti HW/SW specifici.
- PHP: >= 5.* 
	- **N.B.**: Testato fino a PHP 7.4.3 
- Libreria GD come estensione al PHP: opzionale, o versione 2.0 e successive
- Host server - Sistema operativo e server HTTP: qualunque
- Utente - Sistema operativo e browser: qualunque

## Special tanks to... 
- *fanatiko* ideatore e sviluppatore originale di fanKounter
- Tutti coloro che segnalano problemi e malfunzionamenti o danno suggerimenti.
