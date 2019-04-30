<?php

namespace App\Model;

use App\Http\Controllers\Admin\RoleController;
use Illuminate\Database\Eloquent\Model;
use APP\Model\Role;

class User extends Model
{
    //1.关联的数据表
    public $table = 'user';

    //2.主键
    public $primaryKey = 'user_id';

    //3.允许批量操作的字段
//    public $fillable = ['user_name','user_pass','phone'];
    public $guarded = [];
//    4.是否维护crated_at和updated_at字段
    public $timestamps = false;

    //    添加动态属性，关联角色模型

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role()
    {
        return $this->belongsToMany('APP\Model\Role','user_role','user_id','role_id');
    }


}

