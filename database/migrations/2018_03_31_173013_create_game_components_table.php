<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_components', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
	        $table->integer( 'game_id' );
	        $table->integer( 'component_type_id' );
	        $table->integer( 'details_id' )->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_components');
    }
}
