<?php
namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

class CourseHelper extends Helper
{
    public function translate($title)
    {
    	return Configure::read('course.statusesTranslated')[$title];
    }
}