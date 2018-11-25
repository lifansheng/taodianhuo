<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Gpic extends Model
{
    //
    protected $table = 'gpic';

    protected $primaryKey = 'id';

 	public $timestamps = false;
    /**
	 * 不可被批量赋值的属性。
	 *
	 * @var array
	 */
	protected $guarded = [];
}
