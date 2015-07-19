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
		<title>hping - <?php if($_GET['server'] == '') { echo 'Home'; } else { echo $_GET['server']; } ?></title>
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
			<li>
				<a class="s" href=".?s=4">FEATURES</a>
			</li>
			<li class="right">
				<form action="." method="get" class="right">
					<input type="text" name="server" id="domain_input" value="ismysiteonline.com" onclick="cDI(this);" />
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
	                        echo ("<div class='main'><p class='status'>This be no Man-O-War!</p></div>");
                	    break;
                        case 1:
                           	echo ("<div class='main'><p class='status'>Thar <a href='http://$server/'>she</a> blows!</p></div>");
                        break;
                       	case 2:
                           	echo ("<div class='main'><p class='status'>Shiver me timbers! Swab that Poop deck!</p></div>");
                        break;
                        case 3:
                           	echo ("<div class="miss"><img src="hping.png"><p>Yer Crow's nest in Davy Jones's Locker!</p></div>");
						break;
                        }
                ?>
		<!--hr />
		<div class="left">
			<p>Site/Design by Thesp<br />Logo by dansup</p>
		<div class="right">
			<p></p>
		</div-->
	</body>
</html>
<?php
	function clean($ip) {
				$input = $ip;
    if((strstr($input,'[')) && (strstr($input,']'))) {
     $start =strpos($input, '[')+1;
     $length = strpos($input, ']')-$start;
     $output = substr($input, $start,$length);
     return $output;
    } else if ((strstr($input, 'http://'))) {
     $start =strpos($input, '/', 6)+1;
     $length = strlen($input)-$start;
     if(strpos($input, '/', 8)) {
     	$length = strpos($input, '/', 8)-$start;
					}
     $output = substr($input, $start,$length);
     return $output;
    } else {
					return str_replace(array("http:","/","[","]"),"",$ip);
				}
	}
	function check($ip) {
		$ipp = $ip;
		if(substr_count($ipp, ":") == 7) {
			return "[$ipp]";
		} else {
			return $ip;
		}
	}
?>