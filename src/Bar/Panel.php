<?php

namespace MilanKyncl\Debugbar\Bar;

/**
 * @package    barorey.cz
 * @author     Milan Kyncl <milan@friendlystudio.cz>
 * @date 03.11.17
 */

abstract class Panel extends \Phalcon\Mvc\User\Component {

	protected $_icon;
	protected $_title;

	public function boot() {}

	public function shutdown() {}

	public function getIcon() { return $this->_icon; }

	public function getLabel() { return; }

	public function getTitle() { return $this->_title; }

}