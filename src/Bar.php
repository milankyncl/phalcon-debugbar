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

			echo file_get_contents(__DIR__ . '/assets/build/js/debugbar.min.js');

			die();

		}

		if(isset($_GET['mk_debugbar_assets']) && $_GET['mk_debugbar_assets'] == 'css') {

			echo file_get_contents(__DIR__ . '/assets/build/css/debugbar.min.css');

			die();

		}

	}

	public function addPanel(Array $panel) {

		$this->_panels[] = $panel;

	}

	public function render() {

		$renderMethod = require_once __DIR__ . '/assets/bar/bar.php';

		return $renderMethod($this->_panels);

	}

}