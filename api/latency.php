<?php
/*
 *    /api/latency.php
 *    Author: Thesp
 *    Version: 0.X.X
 *    Returns:
 *       0 : Offline
 *       2 : Invalid URL
 *       3 : $S not set
 *       anything else : latency in milliseconds
 */
include_once "../latency.php";
$hLatency = new hLatency
echo $hLatency->newPing($_GET['s']);
?>