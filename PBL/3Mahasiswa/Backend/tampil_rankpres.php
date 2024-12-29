<?php
//class ranking dipanggil & disimpan di session
session_start(); //ambil data dari session
require 'Ranking.php';

$ranking = new Ranking("NXST-planet\DBMS2022", "PBL_DB");
$results = $ranking->getRanking(); //memanggil method getRanking() dari class Ranking

$_SESSION['ranking_results'] = $results;
?>