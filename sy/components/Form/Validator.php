<?php
namespace Sy\Form;

class Validator {

	public function email($value) {
		return filter_var($value, FILTER_VALIDATE_EMAIL);
	}

}

?>
