<?php

namespace MilanKyncl\Debugbar\Bar\Panels;


class ExecutionTimer extends \MilanKyncl\Debugbar\Bar\Panel {

	private $_timer;

	protected $_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60"><path d="M30,0a1,1,0,0,0-1,1V14.29a1,1,0,1,0,2,0V2a28,28,0,1,1-20.83,8.22A1,1,0,0,0,8.75,8.82,30,30,0,1,0,30,0Z"></path><path d="M28.56,33.53A3.56,3.56,0,0,0,31.16,35h0.28a3.56,3.56,0,0,0,2.09-6.45L20.59,19.19a1,1,0,0,0-1.4,1.4Zm3.8-3.36a1.56,1.56,0,1,1-2.18,2.19l-5.71-7.9Z"></path></svg>';


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