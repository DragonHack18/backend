<?php

use Slim\Http\Request;
use Slim\Http\Response;


$app = new \Slim\App;

// Get Money value in bank
$app->get('/api/amount', function (Request $request, Response $response) {
    $sql = "SELECT * FROM walletpimoney";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $moneyamount = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        $value = "error";
        foreach ($moneyamount as $data) {
            $value = $data->money;
        }
        echo $value;
    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

// Send transaction
$app->get('/api/pay/{amount}/{walletid}', function (Request $request, Response $response) {
    $walletid = $request->getAttribute('walletid');
    $amount = $request->getAttribute('amount');

    $sql = "UPDATE `walletpimoney` SET `payment_request`=$amount, `payment_approved` = 0 WHERE id = $walletid";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        echo json_encode('{"notice": {"Successfully added payment request"}}');

        $output = shell_exec('sudo /usr/bin/python3.5 /home/pi/Desktop/hardware.py 2>&1');
        echo "Output shell exec: $output" . "</br>";

    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

// Payment approved
$app->get('/api/pay/paymentapproved', function (Request $request, Response $response) {
    $sql = "SELECT * FROM walletpimoney WHERE id = 1";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        $value = "error";
        foreach ($customer as $data) {
            $value = $data->payment_approved;
        }
        echo $value;

    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

$app->get('/api/approvepayment', function (Request $request, Response $response) {
    $sql = "UPDATE `walletpimoney` SET `money` = `money` - `payment_request`, `payment_approved` = 1 WHERE id = 1";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        echo json_encode('{"notice": {"Successfully approved payment"}}');
    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

