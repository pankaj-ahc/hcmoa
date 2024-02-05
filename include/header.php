<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HCMOA Election 2024</title>
    <link href="./include/bootstrap.min.css" rel="stylesheet">
    <script src="./include/bootstrap.bundle.min.js"></script>
    <script src="./include/jquery.min.js"></script>
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
            background: linear-gradient(359deg, #09f656, transparent);
            box-shadow: 3px 6px 8px 0 #c6c6c6;
            box-shadow: 0px 0px 18px 3px green;
            border-color: yellow!important;
            border-width: 4px;
        }
        .btn-check:checked ~ .userName {
            z-index: 999;
            background: green;
            color: yellow;
            /*box-shadow: inset 0 0 16px 2px #00ff53, inset 0 0 17px 4px yellow;*/
            border-color: #ffff00!important;
            border-width: 1px 4px 4px;
            border-style: solid;
            border-radius: 0%;
            border-radius: 35px 0;
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
        .hide{
            /*color: white!important;*/
            /*background: white!important;*/
        }
        .candidate-element{
            width: 150px;
            height: 150px;
            background-image: url(./user.png);
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            /*overflow: hidden;*/
        }
        .candidate-element label{
            height: 100%;
            position: relative;
            z-index: 10;
        }
        .candidate-element .userName{
            background: gray;
            width: 100%;
            text-align: center;
            color: white;
            border-radius: .5rem .5rem 0 0 ;
            line-height: 0.9;
            padding: 5% 0;
        }
    </style>
</head>
<body>
<nav class="navbar hide" style="max-height:50px;background-color: #e3f2fd;">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 mx-auto h1 hide">HCMOA Election 2024</span>
    </div>
</nav>
<?php
session_start();
include_once "functions.php";