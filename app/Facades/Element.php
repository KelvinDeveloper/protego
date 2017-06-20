<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Element extends Facade
{
	protected static function getFacadeAccessor () {
		return 'element';
	}
}