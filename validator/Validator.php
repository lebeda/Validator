<?php

class Validator extends ValidatorRulesProvider {
	
	protected $specialAplhabet = 'áäčďéëěíïňóöřšťúůüýÿžÁÄČĎÉËÍÏŇÓÖŘŠŤÚŮÜÝŸŽĚçãõâêôàÇÃÕÂÊÔÀĹĽĺľŔŕ';

	protected function alpha($input) {
		throw new NotImplementedException(
			'The validation function ' . __CLASS__ . '::' . __METHOD__ . ' is not implemented.'
		);
	}
	
	protected function alphaNumeric($input) {
		throw new NotImplementedException(
			'The validation function ' . __CLASS__ . '::' . __METHOD__ . ' is not implemented.'
		);
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
	
	protected function ip($input) {
		if (!$this->ipv4($input)) {
			if ($this->ipv6($input)) {
				return TRUE;
			}
			
			return FALSE;
		} elseif (!$this->ipv6($input)) {
			if ($this->ipv4($input)) {
				return TRUE;
			}
			
			return FALSE;
		}
		
		return FALSE;
	}
	
	protected function ipv4($input) {
		return filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)
			? TRUE
			: FALSE;
	}
	
	protected function ipv6($input) {
		return filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)
			? TRUE
			: FALSE;
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
		if (is_null($maxRange)) {
			return TRUE;
		} else {
			return ($maxRange >= str_replace(',', '.', $input));
		}
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
		if (is_null($minRange)) {
			return TRUE;
		} else {
			return ($minRange <= str_replace(',', '.', $input));
		}
	}
}
