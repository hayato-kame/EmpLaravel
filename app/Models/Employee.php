<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

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

    // 今回は、バリデーションは、モデルクラスには定義してません。サービスプロバイダー ValidatorServiceProvider　を使ってます EmployeeFormRequest.phpファイルを見てください。

    // departmentsテーブルが親テーブルで employeesテーブルが子テーブル
    // つまり、１つの部署の下に 複数の社員が存在しているという関係
    // 部署にはたくさんの社員がいる   (部署 hasMany 社員)
    // 社員はどこか１つの部署に所属している  (社員 belongsTo 部署）
    // belongsTo設定 従データなので
    public function department()  // 単数系のメソッドにすること 1対多
    {
        return $this->belongsTo(Department::class,'department_id');
        // return $this->belongsTo('App\Models\Department');
    }

    // photosテーブルが親テーブルで employeesテーブルが子テーブル
    // belongsTo設定  従データなので
    public function photo()  // 単数系のメソッドにすること 1対1
    {
        return $this->belongsTo(Photo::class, 'photo_id');
    }

    // 検索用スコープ
    public function scopeSearch($query, $dep_id, $emp_id, $word)
    {
        if(!empty($dep_id)){
            $query->where('department_id', $dep_id);
        }
        if(!empty($emp_id)){
            $query->where('employee_id', $emp_id);
        }
        if(!empty($word)){
            //  $query->where('name', 'like', "%{$word}%");
            $query->where('name', 'like', '%' . $word . '%');
        }
        return $query;
    }

    /**
     * 住所を表示する
     *
     * @return string
     */
    public function getFullAddress(): string {
        return '〒' . $this->zip_number . $this->pref . $this->address1 . $this->address2 . $this->address3;
    }

    /**
     * 性別を int から strign型にする
     *
     * @param int $gender
     * @return string 1:男<br>2:女
     */
    public function getStringGender($gender)
    {
        $str = "";
        switch($gender) {
            case 1:
                $str = "男";
                break;
            case 2:
                $str = "女";
                break;
        }
        return $str;
    }

    



}
