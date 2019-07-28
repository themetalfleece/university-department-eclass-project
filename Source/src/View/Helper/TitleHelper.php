<?php
namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

class TitleHelper extends Helper
{
    public function set($title)
    {
    	$this->_View->assign('title', __('Τμήμα {0}', Configure::read('department.name') . ' | ' . $title));
    }
}