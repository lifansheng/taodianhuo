<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    // 
    protected $table = 'news';

    protected $primaryKey = 'id';

 	public $timestamps = false;
    /**
	 * 不可被批量赋值的属性。
	 *
	 * @var array
	 */
	protected $guarded = [];
}
