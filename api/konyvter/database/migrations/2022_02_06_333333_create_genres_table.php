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
            array('genre'=>'Regény'),
            array('genre'=>'Fantasy-irodalom'),
            array('genre'=>'High fantasy'),
            array('genre'=>'Sci-fi'),
            array('genre'=>'Filozófia'),
            array('genre'=>'Disztópikus fikció')
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
