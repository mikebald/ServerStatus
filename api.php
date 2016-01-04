<?php
    function getStatus($ip, $port) {
        $socket = @fsockopen($ip, $port, $errorNo, $errorStr, 2);
        if (!$socket) return false;
        else return true;
    }

    function parser() {
        $servers = simplexml_load_file("servers.xml");
        foreach ($servers as $server) {
            if (getStatus((string)$server->ip, (string)$server->port)) {
                $server->online = "true";
            }
            else {
                $server->online = "false";
            }
        }
        return $servers;
    }
    echo json_encode(parser(), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    

    function getStatus($ip, $port)
    {
        $socket = @fsockopen($ip, $port, $errorNo, $errorStr, 2);
        if (!$socket) return false;
        else return true;
    }

    function addServer($name, $host, $port)
    {
        // TODO : rewrite the opening part correctly (better errors management)
        $i = 0;
        $filename = 'servers.xml';

        $servers = file_get_contents("servers.xml");
        if (trim($servers) == '')
        {
            exit();
        }
        else
        {
            $servers = simplexml_load_file("servers.xml");
            foreach ($servers as $server) $i++;
        }

        $servers = simplexml_load_file($filename);
        $server = $servers->addChild('server');

        $server->addAttribute('id', (string) $i);
        if(strlen($name) == 0) $name = $host;
        $server->addChild('name', (string)$name);
        $server->addChild('host', (string)$host);
        $server->addChild('port', (string)$port);
        $servers->asXML($filename);
    }

    function parser()
    {
        //TODO : Fix errors when no valid XML content inside file.
        $file = "servers.xml";
        if(file_exists($file))
        {
            $servers = file_get_contents("servers.xml");
            if (trim($servers) == '') //File exists but empty
            {	
                $content = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><servers></servers>";
                file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
            }
            else
            {
                $servers = simplexml_load_file("servers.xml");
                foreach ($servers as $server)
                {
                    echo "<tr>";
                    echo "<td>".$server->name."</td>";
                    if(filter_var($server->host, FILTER_VALIDATE_IP))
                    {
                        echo "<td class=\"text-center\">N/A</td><td class=\"text-center\">".$server->host."</td>";	
                    }
                    else
                    {
                        echo "<td class=\"text-center\">".$server->host."</td><td class=\"text-center\">".gethostbyname($server->host)."</td>";
                    }

                    echo "<td class=\"text-center\">".$server->port."</td>";

                    if (getStatus((string)$server->host, (string)$server->port))
                    {
                        echo "<td class=\"text-center\"><span class=\"label label-success\">Online</span></td>";
                    }
                    else 
                    {
                        echo "<td class=\"text-center\"><span class=\"label label-danger\">Offline</span></td>";
                    }
                    echo "<td class=\"text-center deleteMode\"><a href=\"index.php?del=".$server->attributes()."\" style=\"text-decoration:none\"><b style=\"color:red;\">X</b></a></td>";
                    echo "</tr>";
                }
            }
        }
        else
        {
            // TODO : detect creation errors (ex : permissions)
            $content = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><servers></servers>";
            file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
        }
    }

    function deleteServer($index)
    {
        $file = "servers.xml";

        $serverFile = new DOMDocument;
        $serverFile->formatOutput = true;
        $serverFile->load($file);
        $servers = $serverFile->documentElement;
        $list = $servers->getElementsByTagName('server');
        $nodeToRemove = null;

        foreach ($list as $server)
        {
            $attrValue = $server->getAttribute('id');
            if ((int)$attrValue == $index) $nodeToRemove = $server;
        }

        if ($nodeToRemove != null) $servers->removeChild($nodeToRemove);

        $serverFile->save($file);
        header('Location: index.php');
    }
?>
