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
            // br(eak_durationカラムが存在する場合、型をTIMEに変更する
            $table->time('break_duration')->nullable()->change();
            $table->string('work_duration')->nullable()->change();
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
                // break_durationカラムを元のinteger型（または他の型）に戻す
                $table->integer('break_duration')->nullable()->change();
            }
        );
    }
}
