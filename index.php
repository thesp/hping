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
	require_once "latency.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>hping - <?php if($_GET['server'] == '') { echo 'Home'; } else { echo $_GET['server']; } ?></title>
		<link rel="stylesheet" type="text/css" href="./styles.css" />
		<script type="text/javascript">
			function cDI(d) {
			if(d.cleared) { 
				return; 
			}
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
				<a class="s" href="features/">FEATURES</a>
			</li-->
			<li class="right">
				<form action="" method="get" class="right">
					<input type="text" name="server" id="domain_input" value="ismysiteonline.com" onclick="cDI(this);" />
					<input type="submit" style="display:none;" />
				</form>
			</li>
		</ul>
		<?php
			echo("<div class='output'>");
			$hLatency = new hLatency;
			$r = $hLatency->newPing($_GET['s']);
			$server = $_GET['s'];
			echo("</div>");
			switch ($r) {
				case -1:
					echo ("<div class='main'><p class='status'>$server is  offline</p></div>");
				break;
				/*case 1:
				*	echo ("<div class='main'><p class='status'><a href='http://$server/'>$server</a> is online</p></div>");
				break;*/
				case -2:
					echo ("<div class='main'><p class='status'>This is not a valid URL</p></div>");
				break;
				case -3:
					echo ("<div class='main' id='a'><img src='hping.png'><p id='m'>We provide platform monitoring and insight into the network.</p></div>");
				break;
				default:
					$r = round($r);
					echo ("<div class='main'><p class='status'><a href='http://$server/'>$server</a> is online with a latency of $r milliseconds</p></div>");
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