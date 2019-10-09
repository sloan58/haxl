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

$query = 'SELECT d.name, d.description, eu.userid FROM device d JOIN enduser eu ON d.fkenduser = eu.pkid WHERE eu.userid NOT LIKE "Token%"';

try {

    $response = $axl->executeSqlQuery(['sql' => $query]);

    $data = is_array($response->return->row) ? $response->return->row : [$response->return->row];

    print implode(',', ['Device Name', 'Device Description', 'UserID']) . "\n";
    
    foreach($data as $d) {
        print implode(',', [$d->name, $d->description, $d->userid]) . "\n";
    }
    
} catch (SoapFault $e) {

    var_dump($e->getMessage());

}