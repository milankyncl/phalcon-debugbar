<?php

/**
 * @package    phalcon-debugbar
 * @author     Milan Kyncl <kontakt@milankyncl.cz>
 * @date 29.10.17
 */

namespace MilanKyncl\Debugbar;

use Phalcon\Di;
use MilanKyncl\Debugbar\Bar;
use MilanKyncl\Debugbar\Timer;

class PhalconDebugbar {

	protected $di;

	private $_timer;

	/**
	 * @var $_bar Bar
	 */

	private $_bar;

	function __construct(Di $di) {

		$this->di = $di;

		$this->timer('boot');

	}

	/**
	 * Timer methods
	 */

	private function timer($name) {

		$this->_timer[$name] = microtime(true);

	}

	private function getTimerDelay($start, $end) {

		$delay = ($this->_timer[$end] - $this->_timer[$start]) * 1000;

		return round($delay, 1);

	}

	/**
	 * Bar methods
	 */

	public function renderBar() {

		echo PHP_EOL . $this->_bar->render();

	}

	public function shutdown() {

		$this->timer('shutdown');

		$this->_bar->addPanel([
			'label' => $this->getTimerDelay('boot', 'shutdown') . ' ms',
			'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60"><path d="M30,0a1,1,0,0,0-1,1V14.29a1,1,0,1,0,2,0V2a28,28,0,1,1-20.83,8.22A1,1,0,0,0,8.75,8.82,30,30,0,1,0,30,0Z"/><path d="M28.56,33.53A3.56,3.56,0,0,0,31.16,35h0.28a3.56,3.56,0,0,0,2.09-6.45L20.59,19.19a1,1,0,0,0-1.4,1.4Zm3.8-3.36a1.56,1.56,0,1,1-2.18,2.19l-5.71-7.9Z"/></svg>'
		]);

		$this->renderBar();

	}

	const DEVELOPMENT = true,
		  PRODUCTION = false;

	/**
	 * @param $debugMode bool
	 */

	public function enable($debugMode) {

		if($debugMode) {

			//$databaseConnection = $this->di->get('db');

			$this->_bar = new Bar();

			register_shutdown_function([$this, 'shutdown']);

		}

	}

}