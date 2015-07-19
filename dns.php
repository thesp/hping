<?php
/*
 *    dns.php
 *    Author: Thesp
 *    Version: 2.0.0
 *    Returns:
 *       NULL - unable to resolve
 *       IPv6 address
 */
class hResolve {
    public function dResolve($s) {
		$s = $this->clean($s);
    	if(isset($s)) {
    		$result = dns_get_record(($s), DNS_AAAA);
    		if(!isset($result[0]['ipv6'])) {
    			return "NULL";
    		}
		    return $result[0]['ipv6'];
	    } else {
	    	return "NULL";
    	}
    }
	public function clean($ip) {
        $ip = str_replace(array("[","]"),"",$ip);
        if (stristr($ip, "//")) {
            $start = strpos($ip, '//')+2;
                if(strchr($ip, "//", $start+1) >= $start+1) {
                    $length = strpos($ip, '/')-$start+1;
                } else {
                    $length = strlen($ip)-$start;
                }
            $output = substr($ip, $start,$length);
            $ip =  $output;
        }
        $input = filter_var($ip, FILTER_SANITIZE_URL);
        return $ip;
    }
}
?>
