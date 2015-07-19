<?php
/*
 *    ping.php
 *    Author: Thesp
 *    Version: 0.X.X
 *    Returns:
 *       0 : Offline
 *       1 : Online
 *       2 : Invalid URL
 *       3 : $S not set
 */
include_once "../ping.php";
$hping = new Hping;
echo $hping->newPing($_GET['s']);
?>