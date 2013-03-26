<?php

class Validator extends ValidatorRulesProvider {

	protected function alpha($input) {
		return TRUE;
	}
	
	protected function alphaNumeric($input) {
		return TRUE;
	}
	
	protected function email($input) {
		return TRUE;
	}
	
	protected function float($input) {
		
		return TRUE;
	}
	
	protected function integer($input) {
		if (is_numeric($input)) {
			$potencionalInt = (int) $input;
			if (strlen($potencionalInt) == strlen($input)) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
		
		return FALSE;
	}
	
	protected function ip($input) {
		return TRUE;
	}
	
	protected function ipBase64($input) {
		return TRUE;
	}
	
	protected function maxLength($input, $maxLength = NULL) {
		if (is_null($maxLength)) {
			return TRUE;
		} elseif (
			is_numeric($maxLength)
			&& mb_strlen($input, $this->getCharset()) <= (int) $maxLength
		) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	protected function maxRange($input, $maxRange = NULL) {
		return TRUE;
	}
	
	protected function minLength($input, $minLength = NULL) {
		if (is_null($minLength)) {
			return TRUE;
		} elseif (
			is_numeric($minLength)
			&& mb_strlen($input, $this->getCharset()) >= (int) $minLength
		) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	protected function minRange($input, $minRange = NULL) {
		return TRUE;
	}
}