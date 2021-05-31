<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Photo;
use Illuminate\Support\Facades\File;
use App\Models\Department;


class EmployeesController extends Controller
{
    // 従業員一覧ページの表示
    public function index()
    {
        $employees = Employee::all();  // 戻り値は、Illuminate\Database\Eloquent\Collection のオブジェクトです
        // dd($employees);
        // dd(count($employees));  // 12 などの整数が帰る
        return view('employees.index', [ 'employees' => $employees ]);
    }

    // 新規作成ページと編集ページを兼ねて表示する
    public function new_entry_edit(Request $request)
    {
        $action = $request->action;
        // dd($action);

        //　この処理はビューコンポーザに取り出せたら良い　後で　
        $departments = Department::all();  // セレクトボックスのために必要 戻り値は　Illuminate\Database\Eloquent\Collection
        // dd($departments);  // コレクション
        // dd($departments->all());  // これは　配列に変換したもの  0 => App\Models\Department
        $dep_array = $departments->all();

        // 連想配列にしてください！！

        $dep_name_array = [];
        foreach($dep_array as $dep) {
            // dd($dep->department_name);
            // dd($dep->department_id);
            // 連想配列の作り方 $変数[キー] = 値
            $dep_name_array[$dep->department_id] = $dep->department_name;
        }
        // dd($dep_name_array);  // "D01" => "総務部"  "D02" => "営業部"  "D03" => "経理部" などが入った連想配列になってる

        switch ($action) {
            case 'add':
                $photo = new Photo(); // 親データのインスタンス
                $employee = new Employee(); // 子データのインスタンス

                return view('employees.new_entry_edit',
                    [ 'photo' => $photo, 'employee' => $employee, 'action' => $action, 'dep_name_array' => $dep_name_array ]);
                break;

            case 'edit':
                $photo = Photo::find($request->photo_id);
                $employee = Employee::find($request->employee_id);

                return view('employees.new_entry_edit',
                    [ 'photo' => $photo, 'employee' => $employee, 'action' => $action, 'dep_name_array' => $dep_name_array ]);
                break;
        }



    }

    public function emp_control(Request $request)
    {
        // dd($request->action);
        $action = $request->action;
        switch ($action) {
            case 'add':
                $photo = new Photo();
                if (isset($request->photo_data)) {
                    // dd($request->photo_data);

                    // 一時的に保存しているファイルのパスを取得する
                    $path_name = $request->photo_data->getRealPath();
                    // dd($path_name);  //  "/private/var/folders/mt/vf6k6n6s3hx9nrj2qx2kpc2c0000gq/T/php3iGR4c"  などと取得できます
                    // file_get_contents — ファイルの内容を全て文字列に読み込む 失敗した場合、file_get_contents() は false を返します。
                    $file_data = file_get_contents($path_name);
                    $photo_data = null;
                    if ($file_data !== false) {
                        $photo_data = base64_encode($file_data);
                        // dd($photo_data);
                    }
                    // $info = pathinfo($request->photo_data);
                    // dd($info);
                    $mime_type = $request->photo_data->getMimeType();
                    // dd($request->photo_data->getMimeType());  // "image/jpeg" などと取得できる
                    $param = [
                        'photo_data' => $photo_data,
                        'mime_type' => $mime_type,
                    ];
                    $photo->fill($param)->save();

                } else {
                    // アップロードしてこない場合 null許可してるカラムなので、アップロードして来なくても、良い。
                    // その場合には、親テーブルphotosにデータが無いと、外部キーの photo_id で親テーブルデータがないと怒られるので、子テーブルのemployeesテーブルが登録できないので、
                    // photosテーブルに、 photo_data mime_type　カラムに　null　を入れて、データを登録しておく
                    $photo->photo_data = null;
                    $photo->mime_type = null;
                    // dd($photo->save());  // 成功すると true
                    $photo->save();
                }
                break;
            case 'edit':

                // 先に親データのデータベースから変更する。
                $photo = Photo::find($request->photo_id); // findメソッドの引数はプライマリーキーの値

                // dd($photo);
                // dd($request->photo_data); // ファイルアップロードがあるかどうか 無いと null
                // dd(isset($request->photo_data));  // null判定で isset関数を使う、isset関数はNULL以外であれば戻り値にTRUEを返します。  falseを返せば、 null
                if(isset($request->photo_data) !== false) {  // ファイルアップロードファイルが 選択されてる
                    // dd($request->photo_data->getRealPath()); //   "/private/var/folders/mt/vf6k6n6s3hx9nrj2qx2kpc2c0000gq/T/phpDTUJUv"
                    $path_name = $request->photo_data->getRealPath();
                    $file_data = file_get_contents($path_name);
                    // dd($file_data); // バイナリーデータ
                    // dd (isset($file_data));  // あれば true
                    $photo_data = null;
                    if (isset($file_data)) {
                        // Base64でエンコードする  Base64は、マルチバイト文字列や、画像などのバイナリ・データをテキスト形式に変換する手法の1つ
                        $photo_data = base64_encode($file_data);
                        // dd($photo_data);
                        // dd($request->photo_data->getMimeType());  // "image/jpeg" 　など
                        $mime_type = $request->photo_data->getMimeType();
                        $param = [ 'photo_data' => $photo_data, 'mime_type' => $mime_type];
                        // dd($photo->update($param));  // 成功すれば true

                        $photo->update($param);
                        

                    }



                    // ＄photo->photo_data =

                } else { // ファイルのアップロードは選択されていない
                    dd(isset($request->photo_data));  // false になります


                }


                break;
            case 'cancel':
                // dd($action);
                break;

            }
            return redirect('/employees');
    }

    public function find()
    {

    }

    public function postCSV()
    {

    }

}
