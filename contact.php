<?php

session_start();

use GuzzleHttp\Client;

include_once "error.php";
require_once 'vendor/autoload.php';
require "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$state = $_POST['state'];
	$message = $_POST['message'];

	$url = "https://app.karmacrm.com/api/v2/contacts.json?api_token=$apikey";

	$guzzle = new Client();
    $result = $guzzle->request('POST', $url, [
    	'json' => [
    		"contact" => [
				'first_name' => $firstname,
				'last_name' => $lastname,
				'addresses' => [
					[
						'state' => $state,
						"address_type" => 3
					]
				],
				'phone_numbers' => [
					[
						'number' => $phone,
						"phone_number_type_id" => 3
					]
				],
				'emails' => [
					[
						'email' => $email,
						"secondary_email_type_id" => 3
					]
				],
				'private_notes' => $message,
			],
    	]
		// 'debug' => true,
	]);

	$sheets = [
		date("Y-m-d"),
		"-",
		"-",
		$firstname,
		$lastname,
		$email,
		$phone,
		$state,
		$message
	];

	$_SESSION['sheets'] = $sheets;
	header("Location: $domain/sheets.php");
}