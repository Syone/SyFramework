<?php
namespace Sy\Form;

class Validator {

	public function boolean($value) {
		return filter_var($value, FILTER_VALIDATE_BOOLEAN);
	}

	public function email($value) {
		return filter_var($value, FILTER_VALIDATE_EMAIL);
	}

	public function float($value) {
		return filter_var($value, FILTER_VALIDATE_FLOAT);
	}

	public function int($value) {
		return filter_var($value, FILTER_VALIDATE_INT);
	}

	public function ip($value) {
		return filter_var($value, FILTER_VALIDATE_IP);
	}

	public function url($value) {
		return filter_var($value, FILTER_VALIDATE_URL);
	}
	
}

?>
