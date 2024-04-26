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
            Schema::table('users', function (Blueprint $table) {
                $table->string('matricule')->unique();
                $table->string('poste');
                $table->string('mode_dacces');
                $table->timestamp('created_at');
                $table->string('tel');
            });
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
            $table->dropColumn('created_at');
            $table->dropColumn('poste');
            $table->dropColumn('matricule');
            $table->dropColumn('mode_dacces');
            $table->dropColumn('tel');
        });
    }
};
