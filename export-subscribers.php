<?php
require 'vendor/autoload.php';

use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteSubscribers as SQLiteSubscribers;

$connection = (new SQLiteConnection())->connect();
$sqlite_subscribers = new SQLiteSubscribers($connection);

$subscriber_records = $sqlite_subscribers->getSubscriberEmails();

$datetime = date("YmdHis");
header('Content-Type: application/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=subscribers_export_'.$datetime.'.csv');

$output = fopen('php://output', 'w');

foreach ($subscriber_records as $line){
    fputcsv($output, array($line));
}

fclose($output);


$sqlite_subscribers=null;
$connection=null;
?>