<?php

function index()
{
    require_once('views/home.php');
}

function contact()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once('views/contact.php');
    }
}