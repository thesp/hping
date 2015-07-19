<?php
include_once "../dns.php";
$hresolve = new hResolve;
echo $hresolve->dResolve($_GET['s']);
?>
