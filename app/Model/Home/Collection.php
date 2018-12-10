<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    //
    protected $table = 'collection';

    protected $primaryKey = 'id';

 	public $timestamps = false;
    /**
	 * 不可被批量赋值的属性。
	 *
	 * @var array
	 */
	protected $guarded = [];


}
