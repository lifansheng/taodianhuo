<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //
    protected $table = 'cate';

    protected $primaryKey = 'id';

 	public $timestamps = false;
    /**
	 * 不可被批量赋值的属性。
	 *
	 * @var array
	 */
	protected $guarded = [];
}
