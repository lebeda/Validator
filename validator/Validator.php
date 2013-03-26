<?php

class Validator extends ValidatorRulesProvider {

	protected function alpha($input) {
		return TRUE;
	}
	
	protected function alphaNumeric($input) {
		return TRUE;
	}
	
	protected function email($input) {
		return (bool) filter_var($input, FILTER_VALIDATE_EMAIL);
	}
	
	protected function float($input) {
		if (is_numeric($input)) {
			$input = str_replace(',', '.', $input);
			if ((string) $input === (string) (float) $input) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
		
		return FALSE;
	}
	
	protected function integer($input) {
		if (is_numeric($input)) {
			if ((string) $input === (string) (int) $input) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
		
		return FALSE;
	}
	
	protected function ip($input, $ipVersion = 4) {
		switch ($ipVersion) {
			case 4:
				return filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)
					? TRUE
					: FALSE;
				break;
			case 6:
				return filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)
					? TRUE
					: FALSE;
				break;
			default:
				return FALSE;
				break;
		}
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