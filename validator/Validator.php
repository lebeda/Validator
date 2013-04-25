<?php

require_once __DIR__ . '/ValidatorRulesProvider.php';
require_once __DIR__ . '/NotImplementedException.php';

class Validator extends ValidatorRulesProvider {
	
	protected $specialAplhabet = 'áäčďéëěíïňóöřšťúůüýÿžÁÄČĎÉËÍÏŇÓÖŘŠŤÚŮÜÝŸŽĚçãõâêôàÇÃÕÂÊÔÀĹĽĺľŔŕ';
	
	public function exportToInteger($input) {
		throw new NotImplementedException('Function ' . __METHOD__ . ' is not implented.');
	}

	public function isAlpha($input) {
		$alphaRegularExpression = '~^([a-zA-Z' . $this->specialAplhabet . ']+)$~';
		return (bool) preg_match($alphaRegularExpression, $input);
	}
	
	public function isAlphaNumeric($input) {
		$alphaNumericRegularExpression = '~^([a-zA-Z0-9' . $this->specialAplhabet . ']+)$~';
		return (bool) preg_match($alphaNumericRegularExpression, $input);
	}
	
	public function isEmail($input) {
		return (bool) filter_var($input, FILTER_VALIDATE_EMAIL);
	}
	
	public function isFloat($input) {
		if (is_numeric($input)) {
			$input = $this->translateCommaToDots($input);
			if ((string) $input === (string) (float) $input) {
				return TRUE;
			}
		}
		
		return FALSE;
	}
	
	public function isInteger($input) {
		if (is_numeric($input)) {
			if ((string) $input === (string) (int) $input) {
				return TRUE;
			}
		}
		
		return FALSE;
	}
	
	public function isIp($input) {
		if ($this->isIpv4($input)) {
			return TRUE;
		} elseif ($this->isIpv6($input)) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function isIpv4($input) {
		return filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? TRUE : FALSE;
	}
	
	public function isIpv6($input) {
		return filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ? TRUE : FALSE;
	}
	
	public function isMaxLength($input, $maxLength) {
		if (
			$this->isInteger($maxLength)
			&& mb_strlen($input, $this->getCharset()) <= $maxLength
		) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function isMaxValue($input, $maxValue) {
		if ($this->isInteger($maxValue)) {
			return ((int) $maxValue >= (int) $this->translateCommaToDots($input));
		}
		
		return FALSE;
	}
	
	public function isMinLength($input, $minLength) {
		if (
			$this->isInteger($minLength)
			&& mb_strlen($input, $this->getCharset()) >= $minLength
		) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function isMinValue($input, $minValue) {
		if ($this->isInteger($minValue)) {
			return ((int) $minValue <= (int) $this->translateCommaToDots($input));
		}
		
		return FALSE;
	}
}