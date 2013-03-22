<?php

require_once __DIR__ . '/validator/ValidatorProvider.php';
require_once __DIR__ . '/validator/Validator.php';

$validator = new Validator;
$validator->validate(58, 'integer|minLenght[28]');