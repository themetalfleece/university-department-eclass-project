<?php

namespace App\View\Cell;

use Cake\Collection\Collection;
use Cake\View\Cell;

class ProfessorCell extends Cell
{
	private function getVisitHours($userId)
	{
		$this->loadModel('Professors');
		$this->loadModel('ProfessorVisitHours');

		$visitHours = $this->ProfessorVisitHours->find()
			->where(['professor_id' => $this->Professors->getIdByUser($userId)])
			->order(['day' => 'asc', 'hour_start' => 'asc'])
			->groupBy(function($prof) {
				return $prof->day;
			})->toArray();

		return $visitHours;
	}

	public function visitHours($userId) {
		$this->set('visitHours', $this->getVisitHours($userId));
	}

	public function settings($userId) {
		$this->set('visitHours', $this->getVisitHours($userId));
	}
}