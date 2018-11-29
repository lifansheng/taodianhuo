<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class homes extends Model
{
    //
    protected $table = 'homes';

    protected $primaryKey = 'hid';

 	public $timestamps = false;
    /**
	 * 不可被批量赋值的属性。
	 *
	 * @var array
	 */
	protected $guarded = [];
}
