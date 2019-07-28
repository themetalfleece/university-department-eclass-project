<?php
namespace App\View\Helper;

use Cake\View\Helper;

class ClassHelper extends Helper
{
	private $record = false;
	private $addedCount = 0;

	public function setRecordAddedCount($record) {
		$this->record = $record;
		$this->addedCount = 0;
	}

	public function getRecordedCount() {
		return $this->addedCount;
	}

	private function recordHitAndFormat($class) {
		if ($this->record) {
			$this->addedCount++;
		}

		return ' ' . $class;
	}

	public function addIf($class, $condition) {
		if ($condition) {
			return ' ' . $class;
		}
		
		return '';
	}

	public function addIfAction($class, $action)
	{
		if (strpos($action, '.') !== false) {
			// the controller is contained inside the action
			$parts = explode('.', $action);

			$partsCount = count($parts);

			if ($partsCount < 2) {
				return ''; // something's wrong
			}

			$controller = strtolower($parts[0]);
			$action = strtolower($parts[1]);


			if ($controller === strtolower($this->_View->request->params['controller']) &&
					$action === strtolower($this->_View->request->params['action'])) {

				if ($partsCount === 2) {
					return $this->recordHitAndFormat($class);
				}

				if ($partsCount === 3) {
					// check the parameter as well (case sensitive)
					$parameter = $parts[2];

					if (count($this->_View->request->params['pass']) === 0) {
						return '';
					}

					if ($this->_View->request->params['pass'][0] === $parameter) {
						return $this->recordHitAndFormat($class);
					}
				}

			}

		} else {
			// just the action is specified
			if ($action === $this->_View->request->params['action']) {
				return $this->recordHitAndFormat($class);
			}
		}

		// no match
		return '';
	}
}