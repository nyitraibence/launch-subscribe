<?php
require 'vendor/autoload.php';

use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteSubscribers as SQLiteSubscribers;

$connection = (new SQLiteConnection())->connect();
$sqlite_subscribers = new SQLiteSubscribers($connection);


if (!empty($_POST)){

    $email = $_POST['sub'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if(!$sqlite_subscribers->subscriberExists($email)){
            $inserted_subscriber = $sqlite_subscribers->insertSubscriber($email);
            echo 'Successful subscription!';
        }else{
            echo 'Already subscribed with this email address.';
        }
        
    }else{
        echo 'System found this email invalid.';
    }

}else{
    echo "POST empty.";
}




$sqlite_subscribers=null;
$connection=null;
?>