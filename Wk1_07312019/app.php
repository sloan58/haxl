<?php

try {
    $axl = new SoapClient('../wsdl/10.5/AXLAPI.wsdl',
        [
            'trace' => 1,
            'exceptions' => true,
            'location' => '',
            'login' => '',
            'password' => '',
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