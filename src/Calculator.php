<?php declare(strict_types = 1);

	namespace App;

	use InvalidArgumentException;

	class Calculator {

		public function multiply(float $a, float $b): float {
			return $a * $b;
		}

		public function add(float $a, float $b): float {
			return $a + $b;
		}

		public function divide(float $a, float $b): float {
			if($b == 0) {
				throw new InvalidArgumentException("Division by zero is not allowed");
			}

			return $a / $b;
		}
	}