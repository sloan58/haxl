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

    $response = $axl->getCCMVersion();

    var_dump($response);

} catch (SoapFault $e) {

    var_dump($e->getMessage());

}