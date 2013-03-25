<?php

require_once __DIR__ . '/validator/ValidatorRulesProvider.php';
require_once __DIR__ . '/validator/Validator.php';

$validator = new Validator;
var_dump($validator->validate(58, 'integer|minLength[28]'));