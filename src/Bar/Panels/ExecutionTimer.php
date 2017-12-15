<?php

namespace MilanKyncl\Debugbar\Bar\Panels;


class ExecutionTimer extends \MilanKyncl\Debugbar\Bar\Panel {

	private $_timer;

	protected $_icon = '';

	public function boot() {

		$this->timer('boot');

		parent::boot();
	}


	public function shutdown() {

		$this->timer('shutdown');

		parent::shutdown();
	}


	public function getIcon() {

		return parent::getIcon();
	}

	public function getLabel() {

		return $this->getTimerDelay('boot', 'shutdown') . ' ms';
	}

	/**
	 * Set timer at actual microtime
	 * @param $name
	 */

	private function timer($name) {

		$this->_timer[$name] = microtime(true);

	}

	private function getTimerDelay($start, $end) {

		$delay = ($this->_timer[$end] - $this->_timer[$start]) * 1000;

		return round($delay, 1);

	}

}