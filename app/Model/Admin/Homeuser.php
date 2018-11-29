<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Homeuser extends Model
{
    // 前台用户在后台的模型
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
