<?php

class ValidatorRulesProvider {
	
	const RULE_SEPARATOR = '|';
	const DEFAULT_CHARSET = 'UTF-8';
	const DEFAULT_FUNCTION_PREFIX = 'is';
	
	protected $ruleRegularExpression = '~(?P<rule>[a-zA-Z]+)(?:\[(?P<argument>\w+)\])?\|?~';
	protected $rules = array();
	protected $charset;
	
	public function validate($input, $rules) {
		$this->prepareRules($rules);
		if (!empty($this->rules)) {
			$this->result = FALSE;
			foreach ($this->rules as $rule) {
				$functionName = $this->getValidationFunctionFromRule($rule['rule']);
				if (empty($rule['argument'])) {
					$result = $this->$functionName($input);
				} else {
					$result = $this->$functionName($input, $rule['argument']);
				}
				
				if ($result !== TRUE) {
					return FALSE;
				}
			}
			
			return TRUE;
		}
	}
	
	protected function prepareRules($stringRules) {
		if (is_string($stringRules)) {
			preg_match_all($this->ruleRegularExpression, $stringRules, $matches);
			foreach ($matches['rule'] as $index => $rule) {
				$this->rules[] = array(
					'rule' => $rule,
					'argument' => $matches['argument'][$index]);
			}
		} else {
			throw new InvalidArgumentException('Argument $rules must be a string.');
		}
	}
	
	protected function getValidationFunctionFromRule($rule) {
		return self::DEFAULT_FUNCTION_PREFIX . ucfirst($rule);
	}
	
	public function setCharset($charset = self::DEFAULT_CHARSET) {
		$this->charset = $charset;
	}
	
	protected function getCharset() {
		if (empty($this->charset)) {
			return self::DEFAULT_CHARSET;
		} else {
			return $this->charset;
		}
	}
	
	protected function translateCommaToDots($input) {
		return str_replace(',', '.', $input);
	}
}