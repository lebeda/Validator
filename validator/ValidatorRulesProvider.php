<?php

class ValidatorRulesProvider {
	
	const RULE_SEPARATOR = '|';
	
	protected $ruleRegularExpression = '#(?P<rule>[a-zA-Z]+)(?:\[(?P<argument>\w+)\])?\|?#';
	protected $rules = array();
	
	public function validate($input, $rules) {
		$this->prepareRules($rules);
		if (!empty($this->rules)) {
			$this->result = FALSE;
			foreach ($this->rules as $rule) {
				if (empty($rule['argument'])) {
					$result = $this->$rule['rule']($input);
				} {
					$result = $this->$rule['rule']($input, $rule['argument']);
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
}