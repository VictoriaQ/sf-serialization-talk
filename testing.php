<?php
require __DIR__.'/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
    'base_url' => 'http://localhost:8000',
    'defaults' => [
        'exceptions' => false
    ]
]);

$name = Orion;
$data = array(
    'name' => $name,
    'color' => 'Razzmic Berry',
    'maxSpeed' => '8900'
);

$response = $client->post('/api/spaceships', [
    'body' => json_encode($data)
]);

$response = $client->get('/api/spaceships/'.$name);

echo $response;
echo "\n\n";
