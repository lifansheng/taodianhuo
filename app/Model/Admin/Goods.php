<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    protected $table = 'Goods';

    protected $primaryKey = 'id';

 	public $timestamps = false;
    /**
	 * 不可被批量赋值的属性。
	 *
	 * @var array
	 */
	protected $guarded = [];

	//一对多的关系 

	public function gis()
	{
		return $this->hasMany('App\Model\Admin\Gpic','gid');
	}
}
