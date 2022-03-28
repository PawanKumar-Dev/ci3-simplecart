<?php include 'header.php'; ?>

<div class="container">
	<h3>Thank You, Payment Successful!</h3>
	<h4>Keep payment details safe for future reference.</h4>
</div>

<?php

include 'src/instamojo.php';

$api = new Instamojo\Instamojo('test_9d5390efa5f237fd7b0b8d294d9', 'test_f0cde5c67c48d9ed959519720d5', 'https://test.instamojo.com/api/1.1/');

$payid = $_GET["payment_request_id"];


try {
	$response = $api->paymentRequestStatus($payid);


	echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>";
	echo "<h4>Amount Paid: " . $response['payments'][0]['amount'] . "</h4>";
	echo "<h4>Applicant Name: " . $response['payments'][0]['buyer_name'] . "</h4>";
	echo "<h4>Applicant Email: " . $response['payments'][0]['buyer_email'] . "</h4>";
	echo "<h4>Applicant Mobile Number: " . $response['payments'][0]['buyer_phone'] . "</h4>";
	echo "<pre>";
	print_r($response);
	echo "</pre>";
} catch (Exception $e) {
	print('Error: ' . $e->getMessage());
}



?>

<?php include 'footer.php'; ?>