<?php

header("Content-Type: text/html; charset=utf-8", true);
setlocale(LC_TIME, 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);