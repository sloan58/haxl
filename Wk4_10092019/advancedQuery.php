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

$query = 'SELECT n.dnorpattern, n.description, r.name, n.outsidedialtone FROM numplan n JOIN routepartition r ON n.fkroutepartition = r.pkid WHERE fkroutepartition IN '.
        '(SELECT fkroutepartition FROM callingsearchspacemember WHERE fkcallingsearchspace = ' .
        '(SELECT pkid FROM callingsearchspace WHERE name = "Karma_Internal-CSS")) AND dnorpattern like "9%" AND outsidedialtone = "f" ';

try {

    $response = $axl->executeSqlQuery(['sql' => $query]);

    var_dump($response->return);
} catch (SoapFault $e) {

    var_dump($e->getMessage());

}