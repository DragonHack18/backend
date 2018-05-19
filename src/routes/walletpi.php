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
        echo json_encode($moneyamount);
    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

// Send transaction
$app->get('/api/pay/{amount}/{walletid}', function (Request $request, Response $response) {
    $walletid = $request->getAttribute('walletid');
    $amount = $request->getAttribute('amount');

    $sql = "UPDATE `walletpimoney` SET `payment_request`=$amount WHERE id = $walletid";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customer);
    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

// Payment approved
$app->get('/api/pay/paymentapproved/{walletid}', function (Request $request, Response $response) {
    $walletid = $request->getAttribute('walletid');
    $sql = "SELECT * FROM walletpi WHERE id = $walletid";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customer);
    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

