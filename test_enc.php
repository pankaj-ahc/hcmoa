<?php

// Function to generate a unique code from two passwords
function generateUniqueCode($password1, $password2) {
    $uniqueCode = password_hash($password1 . $password2, PASSWORD_DEFAULT);
    return $uniqueCode;
}

// Function to encrypt data
function encryptData($data, $uniqueCode) {
    $uniqueCode = substr($uniqueCode,5,-5);
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $uniqueCode, 0, '1234567890123456');
    return $encrypted;
}

// Function to decrypt data
function decryptData($encryptedData, $uniqueCode) {
    $decrypted = openssl_decrypt($encryptedData, 'aes-256-cbc', $uniqueCode, 0, '1234567890123456');
    return $decrypted;
}

// Example usage
$password1 = "password1";
$password2 = "password2";
$data = "Sensitive data to encrypt";

// Generate unique code
$uniqueCode = generateUniqueCode($password1, $password2);

// Encrypt data
$encryptedData = encryptData($data, $uniqueCode);
echo "Encrypted data: $encryptedData\n";

// Decrypt data
$decryptedData = decryptData($encryptedData, $uniqueCode);
echo "Decrypted data: $decryptedData\n";
