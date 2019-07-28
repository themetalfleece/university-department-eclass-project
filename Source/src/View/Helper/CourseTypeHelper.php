<?php
namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

class CourseTypeHelper extends Helper
{
    public function translate($type)
    {
    	return Configure::read('course.typesTranslated')[$type];
    }
}