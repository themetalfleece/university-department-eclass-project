<?php
namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

class StudentLevelHelper extends Helper
{
    public function translate($level)
    {
        return Configure::read('student.levelsTranslated')[$level];
    }
}