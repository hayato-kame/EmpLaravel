<?php

namespace App\Http\Controllers;
use App\Models\Department;

use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index()
    {
        // all()クラスメソッドの戻り値は Illuminate\Database\Eloquent\Collection オブジェクトであり、配列を内包していることがわかります。
        // コレクションは配列のように複数の値を一度に扱うことができるクラスです。
        $departments = Department::all();
        return view('departments.index', ['departments' => $departments, ]);
        // view() という関数を呼び出しています。第一引数には表示したいViewを指定しています。
        // departments.index は resources/views/departments/index.blade.php を意味します。
        // 第二引数にはそのViewに渡したいデータの連想配列を指定します。ビュー側では、連想配列のキーの名前の変数名(値は、連想配列の値)が使えます
    }
}
