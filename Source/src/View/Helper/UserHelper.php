<?php
namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

class UserHelper extends Helper
{
    public function fullName($user)
    {
    	if (is_array($user)) {
    		return $user['first_name'] . ' ' . $user['last_name'];
    	}

    	return $user->first_name . ' ' . $user->last_name;
    }

    public function pictureUrl($picture) {
    	if ($picture === null) {
    		return Configure::read('user.defaultPicture');
    	}

    	return Configure::read('user.profile-pictures-dir.relative') . $picture;
    }
}