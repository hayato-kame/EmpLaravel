<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    //primaryKeyの変更
    protected $primaryKey = "employee_id";

    /**
     * IDが自動増分されるか
     *
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = ['employee_id', 'name', 'age', 'gender', 'photo_id', 'zip_number' ,'pref', 'address',
    'department_id', 'hire_date', 'retire_date'];

    protected $dates = ['hire_date', 'retire_date' ];
    
    protected $guarded = ['employee_id', 'photo_id' ,'retire_date'];
}
