<?php

try {
    $axl = new SoapClient('../wsdl/10.5/AXLAPI.wsdl',
        [
            'trace' => 1,
            'exceptions' => true,
            'location' => 'https://axl.karmatek.io:8443/axl',
            'login' => 'haxl-user',
            'password' => '35_@~Lu5#ff`M9g)',
            'stream_context' => stream_context_create([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
//                        'ciphers' => 'SHA1'
                    ]
                ]
            ),
        ]
    );
} catch (SoapFault $e) {
    var_dump($e->getMessage());
}

$query = 'SELECT name FROM device WHERE tkclass = (SELECT enum FROM typeclass WHERE name = "Phone") AND name LIKE "SEP%"';

try {

    $response = $axl->executeSqlQuery(['sql' => $query]);

    // Print AXL Soap Request/Response Headers
    // var_dump($axl->__getLastRequestHeaders());
    // var_dump($axl->__getLastRequest());
    
    // var_dump($axl->__getLastResponseHeaders());
    // print_r($axl->__getLastResponse());
    
    var_dump($response->return->row);
    
} catch (SoapFault $e) {

    var_dump($e->getMessage());

}