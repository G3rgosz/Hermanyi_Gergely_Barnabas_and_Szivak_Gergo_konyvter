<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBgswitchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bgswitches', function (Blueprint $table) {
            $table->foreignId('book_id')->constrained('books');
            $table->foreignId('genre_id')->constrained('genres');
        });
        DB::table('bgswitches')->insert(array('book_id'=>'1','genre_id'=>'1'));
        DB::table('bgswitches')->insert(array('book_id'=>'1','genre_id'=>'2'));
        DB::table('bgswitches')->insert(array('book_id'=>'1','genre_id'=>'3'));
        DB::table('bgswitches')->insert(array('book_id'=>'2','genre_id'=>'1'));
        // DB::table('bgswitches')->insert(array('book_id'=>'2','genre_id'=>'2'));
        DB::table('bgswitches')->insert(array('book_id'=>'2','genre_id'=>'3'));
        DB::table('bgswitches')->insert(array('book_id'=>'3','genre_id'=>'1'));
        DB::table('bgswitches')->insert(array('book_id'=>'3','genre_id'=>'2'));
        DB::table('bgswitches')->insert(array('book_id'=>'3','genre_id'=>'3'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bgswitches');
    }
}
