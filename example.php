<?php

require_once __DIR__ . '/validator/Validator.php';

$validator = new Validator;
var_dump($validator->validate('65465465', 'ip'));