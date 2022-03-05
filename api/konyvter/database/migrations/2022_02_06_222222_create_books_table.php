<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('writer');
            $table->string('publisher')->nullable();
            $table->year('release')->nullable();
            $table->string('language', 50)->nullable();
        });
        DB::table('books')->insert(array(
            'id'=>'1',
            'title'=>'Az utolsó kívánság',
            'writer'=>'Andrzej Sapkowski',
            'publisher'=>'Gabo könyvkiadó',
            'release'=>'1993',
            'language'=>'magyar'
        ));
        DB::table('books')->insert(array(
            'id'=>'2',
            'title'=>'A végzet kardja',
            'writer'=>'Andrzej Sapkowski',
            'publisher'=>'Gabo könyvkiadó',
            'release'=>'1992',
            'language'=>'magyar'
        ));
        DB::table('books')->insert(array(
            'id'=>'3',
            'title'=>'Tündevér',
            'writer'=>'Andrzej Sapkowski',
            'publisher'=>'Gabo könyvkiadó',
            'release'=>'1994',
            'language'=>'magyar'
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
