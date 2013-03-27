<?php

class ValidatorRulesProvider {
	
	const RULE_SEPARATOR = '|';
	const DEFAULT_CHARSET = 'UTF-8';
	const DEFAULT_FUNCTION_PREFIX = 'is';
	
	protected $ruleRegularExpression = '#(?P<rule>[a-zA-Z]+)(?:\[(?P<argument>\w+)\])?\|?#';
	protected $rules = array();
	protected $charset;
	
	public function validate($input, $rules) {
		$this->prepareRules($rules);
		if (!empty($this->rules)) {
			$this->result = FALSE;
			foreach ($this->rules as $rule) {
				if (empty($rule['argument'])) {
					$result = $this->{self::DEFAULT_FUNCTION_PREFIX . $rule['rule']($input)};
				} else {
					$result = $this->{self::DEFAULT_FUNCTION_PREFIX . $rule['rule']($input, $rule['argument'])};
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
					'rule' => ucfirst($rule),
					'argument' => $matches['argument'][$index]);
			}
		} else {
			throw new InvalidArgumentException('Argument $rules must be a string.');
		}
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
}