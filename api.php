<?php
    function getStatus($ip, $port) {
        $socket = @fsockopen($ip, $port, $errorNo, $errorStr, 2);
        if (!$socket) return false;
        else return true;
    }

    
    function getServers() {
        $file = file_get_contents("servers.json");
        $data = json_decode($file);
        
        foreach($data as $key => $entry) {
            $pingTime = ping( $entry["ip"], $entry["port"] );
            $data[$key]['ping'] = $pingTime;
            $data[$key]['online'] = ($pingTime != "down");
        }
        
        echo json_encode($data, JSON_PRETTY_PRINT);
        
    }
    
    function ping($host, $port) 
{ 
        $tB = microtime(true); 
        $fP = fSockOpen($host, $port, $errno, $errstr, 10); 
        if (!$fP) { return "down"; } 
        $tA = microtime(true); 
        return round((($tA - $tB) * 1000), 0)." ms"; 
    }

    function addServer($name, $host, $port)
    {
        $file = file_get_contents("servers.json");
        $data = json_decode($file);
        
        // Finish
    }

    function deleteServer($index)
    {
        $file = file_get_contents("servers.json");
        $data = json_decode($file);
        
        unsert($data[$index]);

        file_put_contents("servers.json", json_encode($data));
        
    }
?>
