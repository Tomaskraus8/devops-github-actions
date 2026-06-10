<?php declare(strict_types = 1);

	require __DIR__.'/../vendor/autoload.php';

	use App\Calculator;

	const COLOR_RED = "31";
	const COLOR_CYAN = "36";

	function colorize(string $text, string $color, $stream): string {
		if(!stream_isatty($stream)) {
			return $text;
		}

		return "\033[".$color."m".$text."\033[0m";
	}

	function fail(string $message): never {
		fwrite(STDERR, colorize($message, COLOR_RED, STDERR).PHP_EOL);
		exit(1);
	}

	if($argc !== 4) {
		fwrite(STDERR, "Usage: calculator <add|multiply|divide> <a> <b>".PHP_EOL);
		exit(1);
	}

	[, $operation, $a, $b] = $argv;

	if(!is_numeric($a) || !is_numeric($b)) {
		fail("Error: operands '$a' and '$b' must be numbers");
	}

	$symbols = [
		'add' => '+',
		'multiply' => '*',
		'divide' => '/',
	];

	if(!isset($symbols[$operation])) {
		fail("Error: unknown operation '$operation', supported: add, multiply, divide");
	}

	$a = (float) $a;
	$b = (float) $b;

	$calculator = new Calculator();

	try {
		$result = $calculator->$operation($a, $b);
	} catch(InvalidArgumentException $e) {
		fail("Error: ".$e->getMessage());
	}

	vprintf("%s %s %s = %s%s", [$a, $symbols[$operation], $b, colorize((string) $result, COLOR_CYAN, STDOUT), PHP_EOL]);
