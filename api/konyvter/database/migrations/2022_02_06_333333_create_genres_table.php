<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('genre', 50)->unique();
        });
        DB::table('genres')->insert(array(
            'id'=>'1',
            'genre'=>'Regény'
        ));
        DB::table('genres')->insert(array(
            'id'=>'2',
            'genre'=>'Fantasy-irodalom'
        ));
        DB::table('genres')->insert(array(
            'id'=>'3',
            'genre'=>'High fantasy'
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genres');
    }
}
