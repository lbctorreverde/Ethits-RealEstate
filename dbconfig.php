<?php
    require __DIR__."/includes/vendor/autoload.php";

    use Kreait\Firebase\Factory;
    use Kreait\Firebase\Auth;

    $factory = (new Factory())
        ->withServiceAccount("includes/agentfinderphp-firebase-adminsdk-x10dy-e517b10813.json")
        ->withDatabaseUri('https://agentfinderphp-default-rtdb.asia-southeast1.firebasedatabase.app');

    $storage = (new Factory())
        ->withServiceAccount('includes/agentfinderphp-firebase-adminsdk-x10dy-e517b10813.json')
        ->withDefaultStorageBucket('agentfinderphp.appspot.com')
        ->createStorage();

    $bucket = $storage->getBucket();

    $database = $factory->createDatabase();
    $auth = $factory->createAuth();
?>