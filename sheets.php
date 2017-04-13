<?php

session_start();

include_once "error.php";
require_once 'vendor/autoload.php';
require "config.php";

define('APPLICATION_NAME', 'Google Sheets API PHP Quickstart');
define('CREDENTIALS_PATH', __DIR__ . '/google/sheets.googleapis.com-php-quickstart.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/google/client_secret.json');

// If modifying these scopes, delete your previously saved credentials
// at ~/.credentials/sheets.googleapis.com-php-quickstart.json
define('SCOPES', implode(' ', [
		Google_Service_Sheets::SPREADSHEETS,
		Google_Service_Sheets::SPREADSHEETS_READONLY
	]
));

if (php_sapi_name() != 'cli') {
	// throw new Exception('This application must be run on the command line.');
}

/**
* Returns an authorized API client.
* @return Google_Client the authorized client object
*/
function getClient() {
	$client = new Google_Client();
	$client->setApplicationName(APPLICATION_NAME);
	$client->setScopes(SCOPES);
	$client->setAuthConfig(CLIENT_SECRET_PATH);
	$client->setAccessType('offline');

	// Load previously authorized credentials from a file.
	$credentialsPath = CREDENTIALS_PATH;
	if (file_exists($credentialsPath)) {
		$accessToken = json_decode(file_get_contents($credentialsPath), true);
	} else {
		die("Credentials does not exist!");
	}

	$client->setAccessToken($accessToken);

	// Refresh the token if it's expired.
	if ($client->isAccessTokenExpired()) {
		$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
		file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
	}

	return $client;
}

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Sheets($client);

// Prints the names and majors of students in a sample spreadsheet:
// https://docs.google.com/spreadsheets/d/1uZdqPlBOexC8ra4sHVSTBRTSaxsPK5_5T7xFkY5eem4/edit
$spreadsheetId = '1uZdqPlBOexC8ra4sHVSTBRTSaxsPK5_5T7xFkY5eem4';
$range = 'Sheet1!A2:I';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

$contactCount = count($values) > 0 ? count($values) + 2 : 2;

$range = "Sheet1!A$contactCount:I";
$body = new Google_Service_Sheets_ValueRange(array(
	'values' => [$_SESSION['sheets']]
));

$params = array('valueInputOption' => 'USER_ENTERED');
$response = $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);

unset($_SESSION['sheets']);
header("Location: $domain?msg=success");