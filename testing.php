<?php
require __DIR__.'/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
    'base_url' => 'http://localhost:8000',
    'defaults' => [
        'exceptions' => false
    ]
]);

$spaceship = 'Orion';
$mission = 'Apolo18';
$data = array(
    'name' => $spaceship,
    'color' => 'Razzmic Berry',
    'maxSpeed' => '8900',
);

//$response = $client->post('/api/spaceships', [
//    'body' => json_encode($data)
//]);

$response = $client->get('/api/spaceships/'.$spaceship);

$data = array(
    'mission' => $mission,
    'budget' => '19.0',
    'email' => 'apolo18@nasa.es',
    'logo' => 'apolo18.png',
    'twitter' => 'apolo18',
);

$response = $client->post('/api/missions', [
    'body' => json_encode($data)
]);

$response = $client->get('/api/missions/'.$mission);

echo $response;
echo "\n\n";
