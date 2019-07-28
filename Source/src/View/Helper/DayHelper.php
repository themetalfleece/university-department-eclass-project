<?php
namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

class DayHelper extends Helper
{
    public function translateFromInt($day)
    {
        return Configure::read('schedule.days')[$day];
    }
}