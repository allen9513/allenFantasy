<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('leagueId', '10');
            $table->string('gameKey', '10');
            $table->string('nickname', '50');
            
            $table->foreign('gameKey')->references('gameKey')->on('FantasyGames');
            $table->unique('leagueId', 'gameKey');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leagues');
    }
};
