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
class hPing {
        public function newPing($s) {
            if(isset($s) && $s != "") {
                $server = $this->clean($s);
                if($server == 2) {
                    return 2;
                }
                $r = $this->ping($server);
                if($r != 0) {
                    return $r;
                } else {
                    return 0;
                }
            } else {
                return 3;
            }
        }
        public function ping($server) {
            $str = exec("ping6 -c 3 -w 3 ".escapeshellarg($server), $ect, $result);
            if($result == 0) {
                return 1;
            } else {
                return 0;
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
            $ip = $this->resolve($input);
            if ($ip == "NULL") {
                $ip =  $output;
            }
            if (strtolower(substr($ip, 0, 2)) === "fc") {
                return $ip;
            }
            return 2;
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
?>