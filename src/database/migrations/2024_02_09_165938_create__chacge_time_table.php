<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChacgeTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // attendancesテーブルのbreak_durationカラムを変更する
        Schema::table('attendances', function (Blueprint $table) {
            $table->decimal('break_duration', 8, 2)->nullable()->change();
            $table->decimal('work_duration', 8, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'attendances',
            function (Blueprint $table) {
                // ここには、カラムの型を変更する前の状態に戻すコードを記述します。
                // 元の型が何であったかに応じて適切に変更してください。
                $table->string('break_duration')->nullable()->change();
                $table->string('work_duration')->nullable()->change();
            }
        );
    }
}
