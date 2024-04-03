<?php
include "./include/header.php";

// Create The First Key
//echo base64_encode(openssl_random_pseudo_bytes(32));

//echo '<br/>';
// Create The Second Key
//echo base64_encode(openssl_random_pseudo_bytes(64));
?>
    <br/>--------------------------------------------------------<br/>
<?php
// Save The Keys In Your Configuration File
define('FIRSTKEY', 'Lk5Uz3slx3BrAghS1aaW5AYgWZRV0tIX5eI0yPchFz4=');
define('SECONDKEY', 'EZ44mFi3TlAey1b2w4Y7lVDuqO+SRxGXsa7nctnr/JmMrA2vN6EJhrvdVZbxaQs5jpSe34X3ejFK/o9+Y5c83w==');
?>
    --------------------------------------------------------<br/>
<?php

$method = "aes-256-cbc";
$iv_length = openssl_cipher_iv_length($method);
$iv = openssl_random_pseudo_bytes($iv_length);

function secured_encrypt($data)
{
    global $method, $iv, $iv_length;
    $first_key = base64_decode(FIRSTKEY);
    $second_key = base64_decode(SECONDKEY);

    $first_encrypted = openssl_encrypt($data, $method, $first_key, OPENSSL_RAW_DATA, $iv);
    $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

    $output = base64_encode($iv . $second_encrypted . $first_encrypted);
    var_dump(base64_encode($first_encrypted), base64_encode($second_encrypted), $output);
    return $output;
}

function encrypt1($data)
{
    global $method, $iv, $iv_length;
    $first_key = base64_decode(FIRSTKEY);

    $first_encrypted = openssl_encrypt($data, $method, $first_key, OPENSSL_RAW_DATA, $iv);
    return $first_encrypted;
}

function encrypt2($first_encrypted)
{
    global $method, $iv, $iv_length;

    $second_key = base64_decode(SECONDKEY);


    $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
    $output = base64_encode($iv . $second_encrypted . $first_encrypted);
    return $second_encrypted;
}

$msg = "Hello I'm Pankaj Verma";
echo "<hr/>";
secured_encrypt($msg);
echo "<hr/>";
echo "<hr/>";
$enc1 = encrypt1($msg);
$enc2 = encrypt2($enc1);
var_dump(base64_encode($enc1), base64_encode($enc2));
echo $output = base64_encode($iv . $enc2 . $enc1);

?>

    --------------------------------------------------------<br/>
<?php
function secured_decrypt($input)
{
    $first_key = base64_decode(FIRSTKEY);
    $second_key = base64_decode(SECONDKEY);
    $mix = base64_decode($input);

    $method = "aes-256-cbc";
    $iv_length = openssl_cipher_iv_length($method);
    $iv = substr($mix, 0, $iv_length);

    $second_encrypted = substr($mix, $iv_length, 64);
    $first_encrypted = substr($mix, $iv_length + 64);

    $data = openssl_decrypt($first_encrypted, $method, $first_key, OPENSSL_RAW_DATA, $iv);
    $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

    if (hash_equals($second_encrypted, $second_encrypted_new))
        return $data;

    return false;
}

echo secured_decrypt($output);
?>