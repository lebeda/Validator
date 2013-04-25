<?php

require_once __DIR__ . '/validator/Validator.php';

$validator = new Validator('UTF-8');
var_dump($validator->validate('65465465', 'ip'));
$validator->export('58', 'integer');