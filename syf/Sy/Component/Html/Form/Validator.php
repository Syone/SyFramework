<?php
namespace Sy\Component\Html\Form;

function boolean($value) {
	return filter_var($value, FILTER_VALIDATE_BOOLEAN);
}

function email($value) {
	return filter_var($value, FILTER_VALIDATE_EMAIL);
}

function float($value) {
	return filter_var($value, FILTER_VALIDATE_FLOAT);
}

function int($value) {
	return filter_var($value, FILTER_VALIDATE_INT);
}

function ip($value) {
	return filter_var($value, FILTER_VALIDATE_IP);
}

function url($value) {
	return filter_var($value, FILTER_VALIDATE_URL);
}