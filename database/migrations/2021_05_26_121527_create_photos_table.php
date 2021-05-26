<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    // employeesテーブルの親テーブルです。
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->bigIncrements('photo_id'); //子テーブルとデータ型を合わせること
            // このbigIncrementsメソッドは、自動インクリメントUNSIGNED BIGINT（主キー）に相当する列を作成します。自動で採番インクリメントする
            // 従テーブルのemployeesでは、unsignedBigIntegerメソッドを使ってください データ型を合わせるため
            // ここでは、Blob型 は書かないでください 下で MEDIUMBLOB でつけます。
            // $table->binary('photo_data')->nullable();
            $table->string('mime_type')->nullable();
            $table->timestamps();
        });
         // ここで　書いてください   MEDIUMBLOB　じゃないと、データが保存できないからです Blob型だと小さすぎる MEDIUMBLOBの書き方はメソッドは無いから
         DB ::statement("ALTER TABLE photos ADD photo_data MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
