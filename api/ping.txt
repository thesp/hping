<?php
/*
 *    /api/ping.php
 *    Author: Thesp
 *    Version: 0.X.X
 *    Returns:
 *       0 : Offline
 *       1 : Online
 *       2 : Invalid URL
 *       3 : $S not set
 */
class Hping
{
	//echo hping();
	public function newPing($s) {
	    if(isset($s) && $s != "") {
	        $server = $this->clean($s);
	        if($server == 2) {
	            return 2;
	        }
	        $r = $this->ping($server);
	        $r = $r + $this->ping($server);
	        $r = $r + $this->ping($server);
	        if($r >= 1) {
	            return 1;
	        } else {
	            return 0;
	        }
	    } else {
	        return 3;
	    }
	}
	public function ping($server) {
	    $str = exec("ping6 -c 1 -w 1 ".escapeshellarg($server), $ect, $result);
	    if($result == 0) {
	        return 1;
	    } else {
	        return 0;
	    }
	}
	public function clean($ip) {
	    $input = filter_var($ip, FILTER_SANITIZE_URL);
	    $ip = $this->resolve($input);
	    if ($ip == "NULL") {
                if (stristr($input, "//")) {
                    $start = strpos($input, '//')+2;
			if(strchr($input, "//", $start+1) >= $start+1) {
	                    $length = strpos($input, '/')-$start+1;
			} else {
			    $length = strlen($input)-$start;
			}
                    $output = substr($input, $start,$length);
                    $input =  $output;
                }
		if (stripos($input, "fc") == 0) {
		    $ip = $input;
		} else if (stripos($input, "fc") == 1) {
		    $ip = $input;
		}
	    }
	    if (stripos($ip, "fc") == 0) {
        	$ip = "[$ip]";
   	    }
	    if ($this->vCheck($ip) != 1 || stripos($ip, "fc") != 1) {
	        return 2;
	    }
	    if((strstr($ip,'[')) && (strstr($ip,']'))) {
	        $start =strpos($ip, '[')+1;
	        $length = strpos($ip, ']')-$start;
	        $output = substr($ip, $start,$length);
	        return $output;
	    } else {
     		return str_replace(array("http:","/","[","]"),"",$ip);
    	    }
	}
	public function vCheck($ip) {
	    if((strstr($ip,'[')) && (strstr($ip,']'))) {
	        return 1;
	    } else {
	        return 0;
	    }
	}
	public function check($ip) {
	    $ipp = $ip;
	    if(substr_count($ipp, ":") == 7) {
	        return "[$ipp]";
	    } else {
	        return $ip;
	    }
	}
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
$hping = new Hping;
echo $hping->newPing($_GET['s']);
?>
