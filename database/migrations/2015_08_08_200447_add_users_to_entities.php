<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersToEntities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
        });
        Schema::table('chapters', function (Blueprint $table) {
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
        });
        Schema::table('images', function (Blueprint $table) {
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
        });
        Schema::table('books', function (Blueprint $table) {
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
        Schema::table('chapters', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
}
