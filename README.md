![#fasnKounter](https://fankounter.hzknight.org/assets/images/fankounter2.0.png)

[![release](http://github-release-version.herokuapp.com/github/lucliscio/fanKounter/release.svg?style=flat)](https://github.com/lucliscio/fanKounter/releases/latest)
[![License](https://poser.pugx.org/lucliscio/fankounter/license)](https://packagist.org/packages/lucliscio/fankounter)
[![Code Climate](https://codeclimate.com/github/lucliscio/fanKounter/badges/gpa.svg)](https://codeclimate.com/github/lucliscio/fanKounter)

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
- PHP: 
  - 5.4.0 e successive
  - 7.0.1 Testato
- Libreria GD come estensione al PHP: opzionale, o versione 2.0 e successive
- Host server - Sistema operativo e server HTTP: qualunque
- Utente - Sistema operativo e browser: qualunque
