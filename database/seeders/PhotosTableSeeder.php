<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
use App\Models\Photo;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Photoモデルクラスで、'photo_id' は、$guarded　プロパティを上書きしてるので、fillメソッドを使った時に、
     * 値をセットしなくても、エラーにならない。
     * protected $fillable = ['photo_data', 'mime_type'];
     * protected $guarded = ['photo_id', 'mime_type' , 'photo_data'];
     * Photoモデルクラスで、$fillable プロパティを上書きしてるので、'photo_data'と'mime_type'カラムには fillメソッドで値を一気にセットできる
     *
     * photosテーブルは、親テーブルで、１対１でリレーションが 子テーブルのemployeesテーブルのデータとあるので、
     * 子テーブルのデータ数だけ、必要です。なので、12データ作成します。
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 12; $i++){ // 子テーブルのデータ数のループ回数にする
            $param = [
                'photo_data' => null,
                'mime_type' => null,
            ];
            $photo = new Photo();
            $photo->fill($param)->save();
            //　下のやり方でも良い
            // DB::table('photos')->insert($param);
        }

    }
}
