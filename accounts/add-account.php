<?php

require_once('../tools/functions.php');
require_once('../classes/account.class.php');

$first_name = $last_name = $username = $password = '';
$first_nameErr = $last_nameErr = $usernameErr = $passwordErr = '';

$productObj = new Account();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $first_name = clean_input($_POST['first_name']);
    $last_name = clean_input($_POST['last_name']);
    $username = clean_input($_POST['username']);
    $password = clean_input($_POST['password']);

    if(empty($first_name)){
        $first_nameErr = 'First Name is required.';
    } 

    if(empty($last_name)){
        $last_nameErr = 'Last Name is required.';
    }

    if(empty($username)){
        $usernameErr = 'Username is required.';
    } else if ($productObj->usernameExist($username)){
        $usernameErr = 'Username already exists.';
    }

    if(empty($password)){
        $passwordErr = 'Password is required.';
    } else if(strlen($password) < 8){
        $passwordErr = 'Password must be at least 8 characters long.';
    } else if(!preg_match('/[A-Za-z]/', $password)){
        $passwordErr = 'Password must contain at least one letter.';
    } else if(!preg_match('/\d/', $password)){
        $passwordErr = 'Password must contain at least one number.';
    } else if(!preg_match('/[@$!%*?&]/', $password)){
        $passwordErr = 'Password must contain at least one special character (@, $, !, %, *, ?, &).';
    }
    
    // If there are validation errors, return them as JSON
    if(!empty($first_nameErr) || !empty($last_nameErr) || !empty($usernameErr) || !empty($passwordErr)){
        echo json_encode([
            'status' => 'error',
            'first_nameErr' => $first_nameErr,
            'last_nameErr' => $last_nameErr,
            'usernameErr' => $usernameErr,
            'passwordErr' => $passwordErr
        ]);
        exit;
    }

    if(empty($first_nameErr) && empty($last_nameErr) && empty($usernameErr) && empty($passwordErr)){
        $productObj->first_name = $first_name;
        $productObj->last_name = $last_name;
        $productObj->username = $username;
        $productObj->password = $password;

        if($productObj->add()){
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Something went wrong when adding the new product.']);
        }
        exit;
    }
}
?>
