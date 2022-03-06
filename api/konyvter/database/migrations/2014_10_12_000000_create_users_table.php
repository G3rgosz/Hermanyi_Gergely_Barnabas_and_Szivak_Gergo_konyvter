<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->char('phone', 11)->nullable();
            $table->boolean('admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(array(
            'id'=>'1',
            'username'=>'admin',
            'password'=>bcrypt('admin'),
            'email'=>'admin@konyvter.hu',
            'admin'=>true,
            'created_at'=>'2022-02-20 18:00:00',
            'updated_at'=>'2022-02-20 18:00:00'
        ));
        DB::table('users')->insert(array(
            'id'=>'2',
            'username'=>'TesztElek',
            'password'=>bcrypt('tesztelek'),
            'email'=>'elek@teszt.hu',
            'phone'=>'36702113423',
            'admin'=>false,
            'created_at'=>'2022-02-20 18:00:00',
            'updated_at'=>'2022-02-20 18:00:00'
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
