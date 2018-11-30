<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $table = 'order';

 	public $timestamps = false;
    /**
	 * 不可被批量赋值的属性。
	 *
	 * @var array
	 */
	protected $guarded = [];

}
