<?php
namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

class CourseLevelHelper extends Helper
{
    public function translate($level)
    {
    	return Configure::read('course.levelsTranslated')[$level];
    }
}