<?php

namespace MilanKyncl\Debugbar\Bar\Panels;

class ViewRender extends \MilanKyncl\Debugbar\Bar\Panel {

	static private $renderStart;

	static private $renderStop;

	/**
	 * @var $view \Phalcon\Mvc\View
	 */

	private $view;

	protected $_icon = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px" viewBox="0 0 51 51" xml:space="preserve"><polygon points="50.956 14.456 25.5 29 0.044 14.456 25.5 0 " fill="#7383BF"/><polygon points="25.5 29 9.7 19.973 0.044 25.456 25.5 40 50.956 25.456 41.3 19.973 " fill="#556080"/><polygon points="25.5 40 9.7 30.973 0.044 36.456 25.5 51 50.956 36.456 41.3 30.973 " fill="#424A60"/></svg>';

	protected $_title = 'View Log';

	public function boot() {

		$di = $this->di;

		if($di->has('view')) {

			$view = $di->get('view');

			$this->di->set('view', function() use ($view, $di) {

				$eventsManager = new \Phalcon\Events\Manager();

				$eventsManager->attach('view', function($event) {

					/**
					 * @var $event      \Phalcon\Events\Event
					 */

					if ($event->getType() == 'beforeRender') {

						self::$renderStart = microtime(true);

					}

					if ($event->getType() == 'afterRender') {

						self::$renderStop = microtime(true);
					}

				});

				$view->setEventsManager($eventsManager);

				return $view;

			});

			$this->view = $view;

		}

		parent::boot();
	}


	public function shutdown() {

		parent::shutdown();
	}


	public function getLabel() {

		$renderTime = (self::$renderStop - self::$renderStart) * 1000;

		return round($renderTime, 1) .' ms';
	}


	public function getWindowContent() {

		echo '<table cellpadding="5" cellspacing="0"><tbody>';

		echo '<tr><td>View Render Level</td><td class="code">';

		switch($this->view->getRenderLevel()) {

			case 5: echo 'LEVEL_MAIN_LAYOUT'; break;
			case 4: echo 'LEVEL_AFTER_TEMPLATE'; break;
			case 3: echo 'LEVEL_LAYOUT'; break;
			case 2: echo 'LEVEL_BEFORE_TEMPLATE'; break;
			case 1: echo 'LEVEL_ACTION_VIEW'; break;
			case 0: echo 'LEVEL_NO_RENDER'; break;

		}

		echo '</td></tr>';

		echo '<tr><td>Layout name</td><td class="code">' . $this->view->getLayout() . '</td></tr>';

		echo '<tr><td>View name</td><td class="code">' . $this->view->getControllerName() . '/' . $this->view->getActionName() . '</td></tr>';

		echo '<tr><td>Disabled</td><td class="code">' . ($this->view->isDisabled() ? 'true' : 'false' ) . '</td></tr>';

		echo '<tr><td>Chaching</td><td class="code">' . ($this->view->isCaching() ? 'true' : 'false' ) . '</td></tr>';

		echo '<tr><td>Params</td><td class="code">';

		foreach($this->view->getParamsToView() as $name => $param) {

			echo '<strong>' . $name . '</strong> - ';

			if(is_scalar($param))
				echo $param;
			else
				echo 'Obj { ... }';

			echo '<br>';
		}

		echo '</td></tr>';

		echo '</tbody></table>';

	}

}