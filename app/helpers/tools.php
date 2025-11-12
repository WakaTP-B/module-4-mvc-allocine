<?php

// YYYY
function year(string $date): string
{
    return date('Y', strtotime($date));
}

// jj-mm-aaaa
function dateFr(string $date): string
{
    return date('d/m/Y', strtotime($date));
}

// Mois - YYYY
function monthYear(string $date): string
{
    $mois = [
        '01' => 'Janvier',
        '02' => 'Février',
        '03' => 'Mars',
        '04' => 'Avril',
        '05' => 'Mai',
        '06' => 'Juin',
        '07' => 'Juillet',
        '08' => 'Août',
        '09' => 'Septembre',
        '10' => 'Octobre',
        '11' => 'Novembre',
        '12' => 'Décembre'
    ];

    // On extrait le mois et l’année à partir de la date
    $timestamp = strtotime($date);
    $numMois = date('m', $timestamp);
    $annee = date('Y', $timestamp);

    // On retourne le mois + année
    return ($mois[$numMois] ?? '') . ' ' . $annee;
}
