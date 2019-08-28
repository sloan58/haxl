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

try {

    $response = $axl->getPhone(['name' => 'SEP234234234234']);

    // Print AXL Soap Request/Response Headers 
    // var_dump($axl->__getLastRequestHeaders());
    // var_dump($axl->__getLastRequest());
    
    // var_dump($axl->__getLastResponseHeaders());
    // print_r($axl->__getLastResponse());
    
    $maxCalls = $response->return->phone->lines->line->maxNumCalls;
    printf("Your max calls are %s\n", $maxCalls);

} catch (SoapFault $e) {

    var_dump($e->getMessage());

}