<?php


require 'auth.php';
require 'vendor/autoload.php';


use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteCreateTable as SQLiteCreateTable;
use App\SQLiteSubscribers as SQLiteSubscribers;


$user = requestAuthentication();


$connection = (new SQLiteConnection())->connect();
$sqlite_subscribers = new SQLiteSubscribers($connection);
$tables = new SQLiteCreateTable($connection);


$subscriber_records = $sqlite_subscribers->getSubscriberRecords();
if($subscriber_records=='unset'){
    $tables->createTables();
    echo 'Successful project setup! Refresh page to proceed.';
    die();
}


$sqlite_subscribers=null;
$connection=null;
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="sqlitetutorial.net">
        <title>Launch page - <?php echo $user; ?></title>
        <link rel="stylesheet" type="text/css" href="css/reset.css">
        <link rel="stylesheet" type="text/css" href="css/admin.css">
    </head>
    <body>
        <div class="container">
            <h1>Launch page</h1>
            <h2>Permission as: <?php echo $user; ?></h2>
            <hr>
            <?php if($subscriber_records!=null){ ?>
            <h4><u>Subscribers:</u><?php echo ' '.count($subscriber_records); ?></h4><br>
            <table style="width:100%;">
                <tbody>
                    <?php foreach ($subscriber_records as $sub) : ?>
                        <tr>
                            <td><?php echo $sub["id"] ?></td>
                            <td><?php echo $sub["email"] ?></td>
                            <td><?php echo $sub["created_at"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <a href="export-subscribers.php" class="button">Export as .csv</a>
            <?php }else{ ?>
            <p>You have no subscribers yet.</p>
            <?php } ?>
        </div>
    </body>
</html>