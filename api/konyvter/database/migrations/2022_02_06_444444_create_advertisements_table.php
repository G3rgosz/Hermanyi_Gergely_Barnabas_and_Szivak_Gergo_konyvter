<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('adtitle', 50);
            $table->text('description');
            $table->integer('price');
            $table->integer('sawcounter')->nullable();
            $table->string('picturepath')->nullable();
            $table->text('badcontent')->nullable();
            $table->foreignId('book_id')->constrained('books');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
        DB::table('advertisements')->insert(array(
            'id'=>'1',
            'adtitle'=>'Vaják első rész eladó',
            'description'=>'A borítója egy kicsit megszakadt, de egyébként kiválló álapotban van',
            'price'=>'1500',
            'sawcounter'=>'2',
            'badcontent'=>'A képen nem oda illő tartalom szerepel',
            'book_id'=>'1',
            'user_id'=>'2',
            'picturepath'=>'/storage/images/TesztElek/1/witcher1.jpg',
            'created_at'=>'2022-02-27 18:00:00',
            'updated_at'=>'2022-02-27 18:00:00'
        ));
        DB::table('advertisements')->insert(array(
            'id'=>'2',
            'adtitle'=>'Vaják második rész eladó',
            'description'=>'kiválló álapotban van, a részletekért keress',
            'price'=>'1600',
            'sawcounter'=>null,
            'badcontent'=>null,
            'book_id'=>'2',
            'user_id'=>'2',
            'picturepath'=>'/storage/images/TesztElek/2/witcher2.jpg',
            'created_at'=>'2022-02-27 18:00:00',
            'updated_at'=>'2022-02-27 18:00:00'
        ));
        DB::table('advertisements')->insert(array(
            'id'=>'3',
            'adtitle'=>'Vaják harmadik rész eladó',
            'description'=>'kiválló álapotban van, a részletekért keress',
            'price'=>'1600',
            'sawcounter'=>'3',
            'badcontent'=>'A képen nem oda illő tartalom szerepel',
            'book_id'=>'3',
            'user_id'=>'2',
            'picturepath'=>'/storage/images/TesztElek/3/witcher3.jpg',
            'created_at'=>'2022-02-27 18:00:00',
            'updated_at'=>'2022-02-27 18:00:00'
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
