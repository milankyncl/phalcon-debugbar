<?php

namespace MilanKyncl\Debugbar\Bar\Panels;


class RouterInterface extends \MilanKyncl\Debugbar\Bar\Panel {

	/**
	 * @var $router \Phalcon\Mvc\Router
	 */

	private $router;

	protected $_icon = '<svg style="margin-top: 1px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 53 53" ><polygon style="fill:#556080;" points="0.5,0 0.5,46 22.5,46 34.5,46 34.5,29 34.5,17 34.5,0 "/><polygon style="fill:#7383BF;" points="22.5,7 0.5,0 0.5,46 22.5,53 "/><line style="fill:none;stroke:#EFCE4A;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="39.5" y1="35" x2="51.5" y2="23"/><line style="fill:none;stroke:#EFCE4A;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="39.5" y1="11" x2="51.5" y2="23"/><line style="fill:none;stroke:#EFCE4A;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="51.5" y1="23" x2="27.5" y2="23"/></svg>';

	protected $_title = 'Router Interface';

	public function boot() {

		$di = $this->di;

		if($di->has('router')) {

			$router = $di->get('router');

			$this->router = $router;

		}

		parent::boot();
	}


	public function shutdown() {

		parent::shutdown();
	}


	public function getLabel() {

		$matchedRoute = $this->router->getMatchedRoute();

		if($matchedRoute)
			return $this->router->getModuleName() . ':' . $this->router->getControllerName() . ':' . $this->router->getActionName();

		return 'NotFound';
	}


	public function getWindowContent() {

		echo '<table cellpadding="5" cellspacing="0"><tbody>';

		$matchedRoute = $this->router->getMatchedRoute();

		echo '<tr><th>ID</th><th>Pattern</th><th>Matched as</th></tr>';

		foreach($this->router->getRoutes() as $route):

			echo '<tr' . ($matchedRoute ? ($matchedRoute->getPattern() == $route->getPattern() ? ' class="highlighted"' : '') : '') . '><td>' . $route->getRouteId() . '</td><td>' . $route->getPattern() . '</td><td>' . ($matchedRoute ? ($matchedRoute->getPattern() == $route->getPattern() ? $this->router->getModuleName() . ':' . $this->router->getControllerName() . ':' . $this->router->getActionName() : '') : '') . '</td></tr>';

		endforeach;

		echo '</tbody></table>';

	}

}