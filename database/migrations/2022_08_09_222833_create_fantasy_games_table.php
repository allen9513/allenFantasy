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
        Schema::create('fantasyGames', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('gameKey', '10');
            $table->string('gameId', '10');
            $table->string('name', '50');
            $table->string('code', '50');
            $table->string('type', '100');
            $table->string('url', '100');
            $table->string('season', '10');
            $table->boolean('isRegistrationOver');
            $table->boolean('isGameOver');
            $table->boolean('isOffseason');
            $table->string('editorialSeason', '10')->nullable();
            $table->string('picksStatus', '50')->nullable();
            $table->boolean('scenarioGenerator')->nullable();
            $table->string('contestGroupId', '25')->nullable();
            $table->string('currentWeek', '10')->nullable();
            $table->boolean('isContestRegActive')->nullable();
            $table->boolean('isContestOver')->nullable();
            $table->boolean('hasSchedule')->nullable();
            $table->boolean('isLiveDraftLobbyActive')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fantasyGames');
    }
};
