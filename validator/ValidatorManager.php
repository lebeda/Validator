<?php

class ValidatorManager {
	
	const RULE_SEPARATOR = '|';
	
	protected $ruleRegularExpression = '#(?P<rule>[a-zA-Z]+)(?P<ruleArguments>\[\w+\])?#';
	protected $rules = array();
	
	public function validate($input, $rules) {
		$this->prepareRules($rules);
		if (!empty($this->rules)) {
			foreach ($this->rules as $rule) {
				
			}
		}
	}
	
	protected function prepareRules($stringRules) {
		if (is_string($stringRules)) {
			$rules = explode(self::RULE_SEPARATOR, $rules);
			foreach ($rules as $rule) {
				$this->rule[] = $this->takeRuleConfigFromString($rule);
			}
		} else {
			throw new InvalidArgumentException('Argument $rules must be a string.');
		}
	}
	
	protected function takeRuleConfigFromString($ruleString) {
		return preg_match($this->ruleRegularExpression, $ruleString);
	}
}