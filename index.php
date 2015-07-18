<?php
/*
 *    /index.php
 *    Author: Thesp
 *    Version: 0.X.X
 */
if(!isset($_GET['server'])) {
        $_GET['server'] = "";
}
if(!isset($_GET['s'])) {
        $_GET['s'] = $_GET['server'];
}
require_once "ping.php";
?>
<!DOCTYPE html>
<html>
        <head>
                <title><?php  if($_GET['s'] == '') { echo 'Home'; } else { echo $_GET['s']; } ?></title>
                <link rel="stylesheet" type="text/css" href="./styles.css" />
                <script type="text/javascript">
                        function cDI(d) {
                                if(d.cleared) { return; }
                                d.cleared = true;
                                d.value = '';
                                d.style.color = '#000000';
                        }
                </script>
        </head>
        <body>
                <ul>
                        <li class="left">
                                <a href="."><h1>hping</h1></a>
                        </li>
                        <!--li>
                                <a href="features/">FEATURES</a>
                        </li>
                        <li>
                                <a href=""> </a>
                        </li-->
                        <li class="right">
                                <form action="" method="get" class="right">
                                        <input type="text" name="s" id="domain_input" value="ismysiteonline.com" onclick="cDI(this);" />
                                        <input type="submit" style="display:none;" />
                                </form>
                        </li>
                </ul>
                <?php
			$hping = new Hping;
                        $r = $hping->newPing($_GET['s']);
                        $server = $_GET['s'];
                        switch ($r) {
        	                case 0:
	                                echo ("<div class='main'><p class='status'>$server is  offline</p></div>");
                	                break;
                        	case 1:
                                	echo ("<div class='main'><p class='status'><a href='http://$server/'>$server</a> is online</p></div>");
                                       	break;
                       	        case 2:
                                	echo ("<div class='main'><p class='status'>This is not a valid URL</p></div>");
                                	break;
                        	case 3:
                                	include "main.txt";
							break;
                        }
                ?>
        </body>
</html>
