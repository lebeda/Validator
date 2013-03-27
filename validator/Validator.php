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
		if ($this->isIpv4($input)) {
			return TRUE;
		} elseif ($this->isIpv6($input)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	protected function isIpv4($input) {
		return filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? TRUE : FALSE;
	}
	
	protected function isIpv6($input) {
		return filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ? TRUE : FALSE;
	}
	
	protected function isMaxLength($input, $maxLength) {
		if (
			$this->isInteger($maxLength)
			&& mb_strlen($input, $this->getCharset()) <= $maxLength
		) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	protected function isMaxRange($input, $maxRange) {
		return ($maxRange >= (int) str_replace(',', '.', $input));
	}
	
	protected function isMinLength($input, $minLength) {
		if (
			$this->isInteger($minLength)
			&& mb_strlen($input, $this->getCharset()) >= $minLength
		) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	protected function isMinRange($input, $minRange) {
		return ($minRange <= (int) str_replace(',', '.', $input));
	}
}