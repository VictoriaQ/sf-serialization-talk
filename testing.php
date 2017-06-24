<?php
require __DIR__.'/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
    'base_url' => 'http://localhost:8000',
    'defaults' => [
        'exceptions' => false
    ]
]);

$data = array(
    'name' => Orion,
    'color' => 'Razzmic Berry',
    'maxSpeed' => '8900'
);

$response = $client->post('/api/spaceships', [
    'body' => json_encode($data)
]);
echo $response;
echo "\n\n";
