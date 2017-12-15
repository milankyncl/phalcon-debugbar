<?php
/**
 * @package    phalcon-debugbar
 * @author     Milan Kyncl <milan@friendlystudio.cz>
 * @date 29.10.17
 */

namespace MilanKyncl\Debugbar;


class Bar {


	private $_panels = [];


	function __construct() {

		$this->registerAssets();

	}

	private function registerAssets() {

		if(isset($_GET['mk_debugbar_assets']) && $_GET['mk_debugbar_assets'] == 'js') {

			echo file_get_contents(__DIR__ . '/assets/build/js/debugbar.js');

			die();

		}

		if(isset($_GET['mk_debugbar_assets']) && $_GET['mk_debugbar_assets'] == 'css') {

			echo file_get_contents(__DIR__ . '/assets/build/css/debugbar.min.css');

			die();

		}

	}

	/**
	 * Add panel to debugbar
	 *
	 * @param Bar\Panel $panel
	 */

	public function addPanel(\MilanKyncl\Debugbar\Bar\Panel $panel) {

		$this->_panels[] = $this->resolvePanelClass($panel);

	}

	private function resolvePanelClass(\MilanKyncl\Debugbar\Bar\Panel $panel) {

		$panel->boot();

		return $panel;

	}

	public function shutdownPanels() {

		foreach($this->_panels as $panel) {

			$panel->shutdown();

		}

	}

	/**
	 * Render debug bar
	 *
	 * @return mixed
	 */

	public function render() {

		$renderMethod = require_once __DIR__ . '/assets/bar/bar.php';

		echo PHP_EOL . $renderMethod($this->_panels);

	}

}