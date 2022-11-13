<?php

define('APP_PATH', dirname(__FILE__) . '/../');

// The order in which you require you packages/classes is important here.
require('config.php');
require('functions.php');
require('data/data.class.php');
require('data/file_data_provider.class.php'); 
require('data/mysqldataprovider.class.php');
require("auth_functions.php");

Data::initialize(new  MySQLDataProvider(CONFIG['DBconnectionString']));
