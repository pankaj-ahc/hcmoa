<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HCMOA Election 2024</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap.bundle.min.js"></script>
    <script src="jquery.min.js"></script>
    <style>
        .btn-check  ~ label {
            box-shadow: 3px 6px 8px 0 #c6c6c6;
            box-shadow: inset 4px 4px 10px -1px #979797bf
        }
        .btn-check:checked ~ label {
            /*background-color: rgba(0, 128, 0, 0.66) !important;*/
            font-weight: bold;
            color: #FFEE58!important;
            /*background: linear-gradient(35deg, #1b2142 , #00a6ffa8);*/
            background: linear-gradient(35deg, #1b421b , #00ff00a8);
            box-shadow: 3px 6px 8px 0 #c6c6c6;
        }
        .closeBtn{
            position: absolute;
            right: 0;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            padding: 0;
            text-align: center;
            cursor: pointer;
            border-color: red;
            border-style: solid;
            color: red;
        }
        .closeBtn:hover{
            background: red;
            color: white;
        }
    </style>
</head>
<body>
<nav class="navbar" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 mx-auto h1">HCMOA Election 2024</span>
    </div>
</nav>
<?php
session_start();
include_once "functions.php";