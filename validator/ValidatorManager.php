<?php

class ValidatorManager implements Validator {
	
	const RULE_SEPARATOR = '|';
	
	protected $ruleRegularExpression = '#(?P<rule>[a-zA-Z]+)(?P<ruleArguments>\[\w+\])?#';
	protected $rules = array();
	
	public function validate($input, $rules) {
		$this->prepareRules($rules);
	}
	
	protected function prepareRules($stringRules) {
		if (is_string($stringRules)) {
			$rules = explode(self::RULE_SEPARATOR, $rules);
			foreach ($rules as $rule) {
				$this->addConcreteRule($rule);
			}
		} else {
			throw new InvalidArgumentException('');
		}
	}
	
	protected function addConcreteRule($rule) {
		if ($this->isValidRule($rule)) {
			
		}
	}
	
	protected function isValidRule($rule) {
		return preg_match($this->ruleRegularExpression, $rule);
	}
}
