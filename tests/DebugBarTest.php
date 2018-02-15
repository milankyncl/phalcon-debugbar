<?php

use PHPUnit\Framework\TestCase;
use Phalcon\Di\Exception as DiException;

final class DebugBarTest extends TestCase {

	public function testIsListening() {

		$this->expectException(DiException::class);

		$debugbar = new MilanKyncl\Debugbar\PhalconDebugbar();

		$debugbar->setDebugMode(true);

		$debugbar->listen();
	}
}