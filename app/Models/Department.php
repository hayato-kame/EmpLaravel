<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    /**
     * モデルのタイムスタンプを更新するかの指示
     *
     * @var bool
     */
    public $timestamps = false;

    //primaryKeyの変更
    protected $primaryKey = "department_id";

    /**
     * IDが自動増分されるか
     *
     * @var bool
     */
    public $incrementing = false;


    
}
