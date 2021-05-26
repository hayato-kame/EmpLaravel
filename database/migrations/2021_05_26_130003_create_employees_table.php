<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    // employeesテーブルは、photosテーブルの従テーブルです そして、departmentsテーブルの従テーブルでもあります。
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
            // 主キーを文字列にする
            $table->string('employee_id', 30)->primary();
            $table->string('name', 50);
            //integerの第二引数には入れないでください！
            // 入れたら、プライマリーキーとして登録されてしまいます。第二引数が0以外になると、true になってしまう, 
            // 第二引数のデフォルト値は、falseなので、trueになると、プライマリーキーになってしまいます！！
            $table->integer('age');
            // 性別は、整数で管理します
            $table->integer('gender');
            
            // 外部キーのフィールド 主テーブルのphotosテーブルの型に合わせる必要がある
            $table->unsignedBigInteger('photo_id');
            //このunsignedBigIntegerメソッドは、UNSIGNED BIGINT同等の列を作成します。
            // photos（主テーブル）の  incrementsメソッドは、UNSIGNED INTEGER主キーとして自動インクリメントの同等の列を作成します。     

            $table->string('zip_number' ,20);
            $table->string('pref', 20);
            $table->string('address1', 100);
            $table->string('address2', 100);
            $table->string('address3', 100);

            //　外部キーのフィールド 主テーブルがdepartmentsテーブルと、型を合わせる必要がある 文字列型 
            $table->string('department_id');

            $table->datetime('hire_date'); // 入社日
            $table->datetime('retire_date')->nullable(); // 退社日
            $table->timestamps();

            // 外部キー制約 従テーブル側に書く
            $table->foreign('department_id')->references('department_id')->on('departments');
            // 外部キー制約 従テーブル側に書く  ->onDelete('cascade') をつける
            $table->foreign('photo_id')->references('photo_id')->on('photos')->onDelete('cascade');

            // ->onDelete('cascade')で 親のデータを削除した時にそのデータに紐づく子のデータも削除される
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
