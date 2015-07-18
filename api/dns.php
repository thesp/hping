<?
echo resolve();
function resolve() {
	if(isset($_GET['s'])) {
		$result = dns_get_record($_GET['s'], DNS_AAAA);
		if(!isset($result[0]['ipv6'])) {
			return "NULL";
		}
		return $result[0]['ipv6'];
	} else {
		return "NULL";
	}
}
?>
