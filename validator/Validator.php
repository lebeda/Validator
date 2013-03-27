<?php

require_once __DIR__ . '/ValidatorRulesProvider.php';
require_once __DIR__ . '/NotImplementedException.php';

class Validator extends ValidatorRulesProvider {
	
	protected $specialAplhabet = 'áäčďéëěíïňóöřšťúůüýÿžÁÄČĎÉËÍÏŇÓÖŘŠŤÚŮÜÝŸŽĚçãõâêôàÇÃÕÂÊÔÀĹĽĺľŔŕ';

	protected function isAlpha($input) {
		throw new NotImplementedException(
			'The validation function ' . __METHOD__ . ' is not implemented.'
		);
	}
	
	protected function isAlphaNumeric($input) {
		throw new NotImplementedException(
			'The validation function ' . __METHOD__ . ' is not implemented.'
		);
	}
	
	protected function isEmail($input) {
		return (bool) filter_var($input, FILTER_VALIDATE_EMAIL);
	}
	
	protected function isFloat($input) {
		if (is_numeric($input)) {
			$input = str_replace(',', '.', $input);
			if ((string) $input === (string) (float) $input) {
				return TRUE;
			}
		}
		
		return FALSE;
	}
	
	protected function isInteger($input) {
		if (is_numeric($input)) {
			if ((string) $input === (string) (int) $input) {
				return TRUE;
			}
		}
		
		return FALSE;
	}
	
	protected function isIp($input) {
		if (!$this->ipv4($input)) {
			if ($this->ipv6($input)) {
				return TRUE;
			}
			
			return FALSE;
		} elseif (!$this->isIpv6($input)) {
			if ($this->isIpv4($input)) {
				return TRUE;
			}
			
			return FALSE;
		}
		
		return FALSE;
	}
	
	protected function isIpv4($input) {
		return filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? TRUE : FALSE;
	}
	
	protected function isIpv6($input) {
		return filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ? TRUE : FALSE;
	}
	
	protected function isMaxLength($input, $maxLength = NULL) {
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
	
	protected function isMaxRange($input, $maxRange = NULL) {
		if (is_null($maxRange)) {
			return TRUE;
		} else {
			return ($maxRange >= str_replace(',', '.', $input));
		}
	}
	
	protected function isMinLength($input, $minLength = NULL) {
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
	
	protected function isMinRange($input, $minRange = NULL) {
		if (is_null($minRange)) {
			return TRUE;
		} else {
			return ($minRange <= str_replace(',', '.', $input));
		}
	}
}
