<?php

define('APP_PATH', dirname(__FILE__) . '/../');


require('config.php');
require('functions.php');
require('data/file_data_provider.class.php');
require('data/data.class.php');
require("auth_functions.php");

Data::initialize(new FileDataProvider(CONFIG['data_file']));
