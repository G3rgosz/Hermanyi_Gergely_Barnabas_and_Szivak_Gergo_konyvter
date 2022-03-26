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
            array('genre'=>'Életmód, egészség'),
            array('genre'=>'Életrajzok, visszaemlékezések'),
            array('genre'=>'Gasztronómia'),
            array('genre'=>'Gyermek és ifjúsági'),
            array('genre'=>'Hobbi, szabadidő'),
            array('genre'=>'Képregény'),
            array('genre'=>'Lexikon, enciklopédia'),
            array('genre'=>'Művészet, építészet'),
            array('genre'=>'Napjaink, bulvár, politika'),
            array('genre'=>'Nyelvkönyv, szótár'),
            array('genre'=>'Pénz, gazdaság, üzleti élet'),
            array('genre'=>'Sport, természetjárás'),
            array('genre'=>'Számítástechnika, internet'),
            array('genre'=>'Tankönyvek, segédkönyvek'),
            array('genre'=>'Társ. tudományok'),
            array('genre'=>'Történelem'),
            array('genre'=>'Tudomány és Természet'),
            array('genre'=>'Utazás'),
            array('genre'=>'Vallás, mitológia'),
            array('genre'=>'Abszurd dráma'),
            array('genre'=>'Családregény'),
            array('genre'=>'Elbeszélő költemény'),
            array('genre'=>'Fantasy'),
            array('genre'=>'Fejlődésregény'),
            array('genre'=>'Háborús regény'),
            array('genre'=>'Horror'),
            array('genre'=>'Kalandregény'),
            array('genre'=>'Kisregény'),
            array('genre'=>'Koreai irodalom'),
            array('genre'=>'Költészet'),
            array('genre'=>'Levélregény'),
            array('genre'=>'Lovagregény'),
            array('genre'=>'Mese'),
            array('genre'=>'Mítosz'),
            array('genre'=>'Napló'),
            array('genre'=>'Novella'),
            array('genre'=>'Ponyvairodalom'),
            array('genre'=>'Remake'),
            array('genre'=>'Romantika'),
            array('genre'=>'Saga'),
            array('genre'=>'Szatíra'),
            array('genre'=>'Vers') 
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
