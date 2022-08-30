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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'userName');
            $table->dropColumn('email');
            $table->dropColumn('email_verified_at');
            $table->boolean('admin');
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->string('userName')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['userName']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('userName', 'name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->dropColumn('admin');
        });
    }
};
