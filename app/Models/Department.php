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
     * Eloquentでは主キーがオートインクリメントで増加する整数値であるとデフォルトで設定されています。
     * そのため、オートインクリメントまたは整数値ではない値を主キーを使う場合は$incrementingプロパティをfalseに設定します。
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = ["department_id", "department_name"]; // ここで設定したカラムが、fillメソッドで一気に保存できるようになります
    protected $guarded = ["department_id"]; // 新規や、更新などでのデータベース保存時に、このカラムの値がなくても、エラーにならないようにする設定です。

    //利用上は部署テーブルが社員テーブルの親ということになるでしょう。
    // つまり、部署の下に社員が存在しているという関係です
    // 部署にはたくさんの社員がいる(部署 hasMany 社員の関係)
    // 社員はどこか１つの部署に所属している(社員 belongsTo 部署）

    // hasMany設定　こっち(departmentsテーブル)が主テーブルです

    public function employees() //複数形のメソッドにする
    {
        return $this->hasMany(Employee::class, "employee_id"); // 第二引数外部キー
        // return $this->hasMany('App\Models\Employee', "employee_id");
    }

    // Departmentのフォームは、Departmentモデルに、バリデーションを記述する
    // バリデーションのルール public　static なクラスメソッドとして定義する 使う側は、クラス名::メソッド名で呼び出せる
    public static $rules = [
        'department_name' => 'required',
    ];

    // バリデーション失敗時のエラーメッセージ
    public static $messages = [
        'department_name.require' => '部署名は必ず入れてください',
    ];

    

}
