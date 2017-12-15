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

	private $_debugMode = false;

	/**
	 * @var $_bar Bar
	 */

	private $_bar;

	function __construct() {

		$this->_bar = new Bar();

	}

	public function listen() {

		if($this->isDebugMode()) {

			/**
			 * Add Panels
			 */

			$this->_bar->addPanel(new \MilanKyncl\Debugbar\Bar\Panels\ExecutionTimer())
			;
			$this->_bar->addPanel(new \MilanKyncl\Debugbar\Bar\Panels\ViewRender());

			$this->_bar->addPanel(new \MilanKyncl\Debugbar\Bar\Panels\DatabaseProfiler());

			$this->_bar->addPanel(new \MilanKyncl\Debugbar\Bar\Panels\RouterInterface());

			// Register shutdown function

			register_shutdown_function([$this, 'shutdown']);

		}

	}

	public function shutdown() {

		// Check for AJAX Request

		if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

			$this->_bar->shutdownPanels();

			$this->_bar->render();

		}

	}

	/**
	 * Set debug mode for IP or with Bool
	 *
	 * @param $debug bool|array
	 */

	public function setDebugMode($debug) {

		if(is_array($debug)) {

			foreach($debug as $ip) {

				if($_SERVER['REMOTE_ADDR'] == $ip)
					$this->_debugMode = true;

			}

		} else {

			$this->_debugMode = $debug;

		}

	}

	/**
	 * Get if debug mode is on
	 *
	 * @return bool
	 */

	public function isDebugMode() {

		return $this->_debugMode;

	}

	/**
	 * Class constants
	 */

	const DEVELOPMENT = true,
		  PRODUCTION = false;

}