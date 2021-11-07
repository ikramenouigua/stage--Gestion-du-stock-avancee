<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('prefix')->unique();
            $table->integer('order');
            $table->timestamps();
        });
        DB::table('settings')->insert(
            array(
               [ 'prefix' => 'SAB',    'order'=>'1' ],
            ));
        Schema::create('group_clients', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nom');
            $table->double('remise');
            $table->timestamps();
        });
        DB::table('group_clients')->insert(
            array(
               [ 'nom' => 'visiteur',    'remise'=>'4' ],
               [ 'nom' => 'invite',    'remise'=>'5' ],
               [ 'nom' => 'client',    'remise'=>'7.8' ],
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
