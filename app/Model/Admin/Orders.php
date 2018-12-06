<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $table = 'order';

    // protected $primaryKey = 'addr';

 	public $timestamps = false;
    /**
	 * 不可被批量赋值的属性。
	 *
	 * @var array
	 */
	protected $guarded = [];


	/**
     * 获得与地址表关联的字段。
     */
    public function orderaddr()
    {
        return $this->hasOne('App\Model\Admin\Address','id');
    }

}
