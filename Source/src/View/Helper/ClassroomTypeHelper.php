<?php
namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

class ClassroomTypeHelper extends Helper
{
    public function translate($type)
    {
    	return Configure::read('classroom.typesTranslated')[$type];
    }
}