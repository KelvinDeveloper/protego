<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Magic extends Facade
{
	protected static function getFacadeAccessor () {
		return 'magic';
	}
}