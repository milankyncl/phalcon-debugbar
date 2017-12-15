<?php

namespace MilanKyncl\Debugbar\Bar\Panels;


class DatabaseProfiler extends \MilanKyncl\Debugbar\Bar\Panel {


	private $_statements = [];

	protected $_icon = '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 53 53" version="1.1" viewBox="0 0 53 53" xml:space="preserve"><path d="m50.455 8c-0.731-4.462-11.174-8-23.955-8s-23.224 3.538-23.955 8h-0.045v37h0.045c0.731 4.461 11.175 8 23.955 8s23.224-3.539 23.955-8h0.045v-37h-0.045z" fill="#424A60"/><g fill="#424A60"><path d="m26.5 41c-13.255 0-24-3.806-24-8.5v12.5h0.045c0.731 4.461 11.175 8 23.955 8s23.224-3.539 23.955-8h0.045v-12.5c0 4.694-10.745 8.5-24 8.5z"/><path d="M2.5 32v0.5c0-0.168 0.018-0.334 0.045-0.5H2.5z"/><path d="M50.455 32c0.027 0.166 0.045 0.332 0.045 0.5V32H50.455z"/></g><g fill="#556080"><path d="m26.5 29c-13.255 0-24-3.806-24-8.5v12.5h0.045c0.731 4.461 11.175 8 23.955 8s23.224-3.539 23.955-8h0.045v-12.5c0 4.694-10.745 8.5-24 8.5z"/><path d="M2.5 20v0.5c0-0.168 0.018-0.334 0.045-0.5H2.5z"/><path d="M50.455 20c0.027 0.166 0.045 0.332 0.045 0.5V20H50.455z"/></g><ellipse cx="26.5" cy="8.5" rx="24" ry="8.5" fill="#7FABDA"/><g fill="#7383BF"><path d="m26.5 17c-13.255 0-24-3.806-24-8.5v12.5h0.045c0.731 4.461 11.175 8 23.955 8s23.224-3.539 23.955-8h0.045v-12.5c0 4.694-10.745 8.5-24 8.5z"/><path d="M2.5 8v0.5c0-0.168 0.018-0.334 0.045-0.5H2.5z"/><path d="M50.455 8C50.482 8.166 50.5 8.332 50.5 8.5V8H50.455z"/></g></svg>';

	protected $_title = 'Database profiler';

	public function boot() {

		$di = $this->di;

		if($di->has('db')) {

			$db = $di->get('db');

			$di->set('profiler', function() {

				return new \Phalcon\Db\Profiler();

			}, true);

			$this->di->set('db', function() use ($db, $di) {

				/**
				 * @var $db \Phalcon\Db\Adapter\Pdo
				 */

				$profiler = $di->get('profiler');

				$eventsManager = new \Phalcon\Events\Manager();

				$eventsManager->attach('db', function($event, $connection) use($profiler) {

					/**
					 * @var $connection \Phalcon\Db\AdapterInterface
					 * @var $event      \Phalcon\Events\Event
					 */

					if ($event->getType() == 'beforeQuery') {
						$profiler->startProfile($connection->getSQLStatement());
					}

					if ($event->getType() == 'afterQuery') {
						$profiler->stopProfile();
					}

				});

				$db->setEventsManager($eventsManager);

				return $db;

			});

		}

		parent::boot();
	}


	public function shutdown() {

		parent::shutdown();
	}


	public function getLabel() {

		$profiler = $this->di->get('profiler');

		$profiles = $profiler->getProfiles();

		if(!empty($profiles)) {

			foreach($profiles as $profile) {

				$this->_statements[] = $profile->getSQLStatement();

			}

			$lastProfile = $profiler->getLastProfile();

			return round(1000 * ($lastProfile->getTotalElapsedSeconds()), 1) . ' ms / ' . count($profiles);

		}

		return '0 ms / 0';
	}

	public function getWindowContent() {

		echo '<table cellpadding="5" cellspacing="0"><tbody>';


		if(!empty($this->_statements)) {

			foreach($this->_statements as $statement) {

				echo '<tr><td class="code">' . $statement . '</td></tr>';

			}

		} else {

			echo '<tr><td style="text-align: center"><em>No queries executed yet.</em></td></tr>';

		}

		echo '</tbody></table>';

	}

}