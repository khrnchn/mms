<?php

$some_data = [
    'catname' => 'Mosque Donation', // Category name
    'catdescription' => 'Category for Mosque Donations', // Category description
    'userSecretKey' => 'rv9xqakc-hum4-hocs-jk1c-y0hmhvndemgj' // Your ToyyibPay user secret key
];

$curl = curl_init();

curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createCategory'); // API endpoint
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

$result = curl_exec($curl);
$info = curl_getinfo($curl);
curl_close($curl);

$obj = json_decode($result);

// Output the result
echo $result;