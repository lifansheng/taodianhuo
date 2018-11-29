<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    //
    protected $table = 'shopcar';

    protected $primaryKey = 'id';

 	public $timestamps = false;
    /**
	 * 不可被批量赋值的属性。
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
     * 获得与商品表关联的字段。
     */
    public function goodcar()
    {
        return $this->hasOne('App\Model\Admin\Goods','id');
    }
}
