<?php

/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 2.0.7
 * 
 * This file is not intended to be easily readable and contains a number of 
 * coding conventions designed to improve portability and efficiency. Do not make
 * changes to this file unless you know what you are doing--modify the SWIG 
 * interface file instead. 
 * ----------------------------------------------------------------------------- */

// Try to load our extension if it's not already loaded.
if (!extension_loaded('wiringpi')) {
	Throw new Exception('wiringPi module not loaded');
}

abstract class wiringpi {
	static function wiringPiSetup() {
		return wiringPiSetup();
	}

	static function wiringPiSetupSys() {
		return wiringPiSetupSys();
	}

	static function wiringPiSetupGpio() {
		return wiringPiSetupGpio();
	}

	static function pullUpDnControl($pin,$pud) {
		pullUpDnControl($pin,$pud);
	}

	static function pinMode($pin,$mode) {
		pinMode($pin,$mode);
	}

	static function digitalWrite($pin,$value) {
		digitalWrite($pin,$value);
	}

	static function digitalWriteByte($value) {
		digitalWriteByte($value);
	}

	static function pwmWrite($pin,$value) {
		pwmWrite($pin,$value);
	}

	static function digitalRead($pin) {
		return digitalRead($pin);
	}

	static function shiftOut($dPin,$cPin,$order,$val) {
		shiftOut($dPin,$cPin,$order,$val);
	}

	static function shiftIn($dPin,$cPin,$order) {
		return shiftIn($dPin,$cPin,$order);
	}

	static function delay($howLong) {
		delay($howLong);
	}

	static function delayMicroseconds($howLong) {
		delayMicroseconds($howLong);
	}

	static function millis() {
		return millis();
	}

	static function serialOpen($device,$baud) {
		return serialOpen($device,$baud);
	}

	static function serialClose($fd) {
		serialClose($fd);
	}

	static function serialPutchar($fd,$c_) {
		serialPutchar($fd,$c_);
	}

	static function serialPuts($fd,$s) {
		serialPuts($fd,$s);
	}

	static function serialDataAvail($fd) {
		return serialDataAvail($fd);
	}

	static function serialGetchar($fd) {
		return serialGetchar($fd);
	}

	static function serialPrintf($fd,$message) {
		serialPrintf($fd,$message);
	}
}

/* PHP Proxy Classes */

?>
