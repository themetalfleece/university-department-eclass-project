<?php
namespace App\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;
use Cake\Utility\Inflector;

class UserRoleHelper extends Helper
{
	public function pluralCamel($user)
	{
		return Inflector::pluralize(Inflector::camelize($user['role']));
	}

	public function camel($user) {
		return Inflector::camelize($user['role']);
	}

	public function translate($role) {
		return Configure::read('user.rolesTranslated')[$role];
	}
}