<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentsController extends Controller
{
    /**
     * 一覧表示する
     */
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

    /**
     * 新規作成と編集の画面を表示する
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function new_entry_edit(Request $request) // フォームからの送信を $requestインスタンスで受け取る
    {
        // dd($request);
        $action = $request->action;
        // dd($request->action);
        $department = new Department;
        // dd($department->department_id);
        switch ($action) {
            case "add":
                break;
            case "edit":

                break;
        }

        return view('departments.new_entry_edit', ['department' => $department, 'action' => $action, ]);
    }

    public function dep_control(Request $request)
    {
        $action = $request->action;
        $f_message = '';
        // dd($request->department_id); //新規作成では、 null
        

    }


}
