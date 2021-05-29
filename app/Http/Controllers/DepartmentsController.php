<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Database\QueryException;  // App\Http\Controllers\QueryException　では無いので注意する

class DepartmentsController extends Controller
{
    /**
     * 一覧表示する  Route::get('/departments', [ DepartmentsController::class, 'index' ])->name('departments.index');
     *
     */
    public function index()
    {
        // all()クラスメソッドの戻り値は Illuminate\Database\Eloquent\Collection オブジェクトであり、配列を内包していることがわかります。
        // コレクションは配列のように複数の値を一度に扱うことができるクラスです。
        $departments = Department::all();
        // dd($departments);
        // dd(count($departments));  // 整数が返る
        return view('departments.index', ['departments' => $departments, ]);
        // view() という関数を呼び出しています。第一引数には表示したいViewを指定しています。
        // departments.index は resources/views/departments/index.blade.php を意味します。
        // 第二引数にはそのViewに渡したいデータの連想配列を指定します。ビュー側では、連想配列のキーの名前の変数名(値は、連想配列の値)が使えます
    }

    /**
     * 新規作成と編集の画面を表示する   Route::get('/departments/new_entry_edit', [ DepartmentsController::class, 'new_entry_edit' ])->name('departments.new_entry_edit');
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function new_entry_edit(Request $request) // フォームからの送信を $requestインスタンスで受け取る
    {
        // dd($request);
        $action = $request->action;
        // dd($request->action);
        // dd($department->department_id);  // hiddenフィールドで送られくる
        switch ($action) {
            case "add":
                $department = new Department;
                break;
            case "edit":
                $department = Department::find($request->department_id);
                break;
        }
        return view('departments.new_entry_edit', ['department' => $department, 'action' => $action, ]);
    }

    /**
     * 部署データを新規作成する処理・部署名を変更する処理・部署データを削除する処理
     * Route::post('/departments/dep_control', [ DepartmentsController::class, 'dep_control' ])->name('departments.dep_control');
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Redirect
     */
    public function dep_control(Request $request)
    {
        $action = $request->action;
        $f_message = '';
        // dd($request->department_name); // フォームに入力された値を取得
        // dd($request->department_id); // hiddenフィールドから送られてくる値 新規作成では、 null
        switch($action){
            case 'add':
                    $last_department = Department::orderby('department_id', 'desc')->first();
                    // dd($last_department);
                    // dd($last_department->department_id);
                    if ($last_department == null) {
                        $result = "D01";  // 初期値
                    } else {
                        $str = substr($last_department->department_id, 1, 2);
                        // dd($str);  // "01" とかになってる
                        // intval関数は引数で設定した値を整数値に変換させることができます。
                        // dd(intval($str) + 1 );   // 2 とかになる
                        $result = sprintf("D%02d", intval($str) + 1 );
                        // dd($result);  //  "D02"  とかになってる
                    }
                        $department = new Department;
                        $department->department_id = $result;  // 文字列を代入
                        $department->department_name = $request->department_name;
                        $department->save();
                        // dd($department);
                        $f_message = '部署データ新規作成しました。';  // フラッシュメッセージ
                break;
            case 'edit':
                $department = Department::find($request->department_id); // findメソッドはプライマリーキーを引数にとる
                $department->department_name = $request->department_name; // フォームから送られた値を取得して、プロパティに代入する
                $department->save();
                $f_message = '部署名を更新しました。';
                break;
            case 'delete':
                $department = Department::find($request->department_id);
                try {  // 子テーブルemployeesの外部キー制約で、->onDelete('restrict')  だと、親を消そうとして、紐づく子テーブルのデータがあったら、エラー発生する
                    $department->delete();
                } catch(QueryException $e) {
                    $f_message = 'この部署は、所属する社員がいるので、削除できませんでした。';
                    return redirect('/departments')->with([ 'flash_message' => $f_message ]);  // return　で即終了して呼び出し元へ戻ります
                }
                $f_message = 'データを削除しました。';
                break;
            }
        return redirect('/departments')->with([ 'f_message' => $f_message ]);  // リダイレクトは、セッションスコープに f_message というキーで、値が保存されます。
    }
}
