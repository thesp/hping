<?
class Dns
	public function resolve($url) {
		if(isset($url)) {
			$result = dns_get_record($url, DNS_AAAA);
			if(!isset($result[0]['ipv6'])) {
				return "NULL";
			}
			return $result[0]['ipv6'];
		} else {
			return "NULL";
		}
	}
}
?>
