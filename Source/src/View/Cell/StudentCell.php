<?php

namespace App\View\Cell;

use Cake\View\Cell;

class StudentCell extends Cell
{

    public function settings($userId)
    {
    	$this->loadModel('Students');
    	$this->set('student', $this->Students->get($this->Students->getIdByUser($userId)));
    }

} 
