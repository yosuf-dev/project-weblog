<?php


require_once 'helpers.php';
session_start();

if(!isset($_SESSION['users'])){
    redirect('auth/login.php');
}