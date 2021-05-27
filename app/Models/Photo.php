<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    //  primaryKeyの変更
    protected $primaryKey = 'photo_id';

    protected $fillable = ['photo_data', 'mime_type'];
    protected $guarded = ['photo_id', 'mime_type' , 'photo_data'];  // 自動採番 後から変更もしない

     // hasOne設定　こっちが主テーブルです 1対1
     public function employee()  //単数形のメソッドにする
     {
         // return $this->hasOne('App\Models\Employee', 'employee_id');
         return $this->hasOne(Employee::class, 'employee_id'); // 第二引数外部キー
     }

    // バリデーションのルール 'file' アップロードされたファイルであること
    // 'image'  画像ファイルであること mimes   MIMEタイプ指定
    // 今回は、フォームリクエストを使うので、そちらに定義する 1MB = 1024KB 2MB =2048KB 5MB =5120KB

    // public static $rules = [
    //     'photo_data' => [ 'nullable','file', 'image', 'max:5120', 'mimes:jpeg, png, jpg, tmp' ],
    // ];

    // エラーメッセージ
    // 今回は、フォームリクエストを使うので、そちらに定義する

    // public static $messages = [
    //     'photo_data.file' => '画像ファイルを選んでください',
    //     'photo_data.image' => '画像ファイルを選んでください',
    //     'photo_data.max' => '5Mを超えています',
    //     'photo_data.mimes' => '画像ファイルは、jpeg png jpg tmpのいずれかにして下さい',

    // ];


}
