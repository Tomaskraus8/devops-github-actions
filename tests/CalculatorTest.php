<?php declare(strict_types = 1);

	namespace Tests;

	use PHPUnit\Framework\TestCase;
	use App\Calculator;

	class CalculatorTest extends TestCase {
		private Calculator $calculator;

		protected function setUp(): void {
			$this->calculator = new Calculator();
		}

		/**
		 * ADD
		 */
		public function testAdd(): void {
			$result = $this->calculator->add(2, 3);
			$this->assertEquals(5, $result);
		}

		public function testAddNegativeNumbers(): void {
			$result = $this->calculator->add(-2, 3);
			$this->assertEquals(1, $result);
		}

		/**
		 * SUBTRACT
		 */
		public function testSubtract(): void {
			$result = $this->calculator->subtract(10, 3);
			$this->assertEquals(7, $result);
		}

		public function testSubtractNegativeResult(): void {
			$result = $this->calculator->subtract(3, 10);
			$this->assertEquals(-7, $result);
		}

		/**
		 * MULTIPLY
		 */
		public function testMultiply(): void {
			$result = $this->calculator->multiply(3, 4);
			$this->assertEquals(12, $result);
		}

		public function testMultiplyWithDecimals(): void {
			$result = $this->calculator->multiply(2.5, 4);
			$this->assertEquals(10.0, $result);
		}

		public function testMultiplyWithZero(): void {
			$result = $this->calculator->multiply(5, 0);
			$this->assertEquals(0, $result);
		}

		/**
		 * DIVIDE
		 */
		public function testDivide(): void {
			$result = $this->calculator->divide(10, 2);
			$this->assertEquals(5, $result);
		}

		public function testDivideByZeroThrowsException(): void {
			$this->expectException(\InvalidArgumentException::class);
			$this->expectExceptionMessage("Division by zero is not allowed");

			$this->calculator->divide(10, 0);
		}

		public function testDivideWithDecimals(): void {
			$result = $this->calculator->divide(7, 2);
			$this->assertEquals(3.5, $result);
		}
	}