<?php

use Felipe\EmrClinica\Models\User;
use Felipe\EmrClinica\Config\Database;

$db = (new Database())->connect();
$userModel = new User($db);