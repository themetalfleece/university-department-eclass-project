<?php
namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

class ExamMeansHelper extends Helper
{
    public function translate($code)
    {
    	return Configure::read('course.examMeansTranslated')[$code];
    }
}