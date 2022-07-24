<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedAndUpdatedUserSomeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->bigInteger( 'created_by' );
            $table->bigInteger( 'updated_by' )->nullable();
        });
        
        Schema::table('meals', function (Blueprint $table) {
            $table->bigInteger( 'created_by' );
            $table->bigInteger( 'updated_by' )->nullable();
        });

        Schema::table('meal_hours', function (Blueprint $table) {
            $table->bigInteger( 'created_by' );
            $table->bigInteger( 'updated_by' )->nullable();
        });

        Schema::table('meal_types', function (Blueprint $table) {
            $table->bigInteger( 'created_by' );
            $table->bigInteger( 'updated_by' )->nullable();
        });

        Schema::table('plannings', function (Blueprint $table) {
            $table->bigInteger( 'created_by' );
            $table->bigInteger( 'updated_by' )->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn( 'created_by' );
            $table->dropColumn( 'updated_by' );
        });
        
        Schema::table('meals', function (Blueprint $table) {
            $table->dropColumn( 'created_by' );
            $table->dropColumn( 'updated_by' );
        });

        Schema::table('meal_hours', function (Blueprint $table) {
            $table->dropColumn( 'created_by' );
            $table->dropColumn( 'updated_by' );
        });

        Schema::table('meal_types', function (Blueprint $table) {
            $table->dropColumn( 'created_by' );
            $table->dropColumn( 'updated_by' );
        });

        Schema::table('plannings', function (Blueprint $table) {
            $table->dropColumn( 'created_by' );
            $table->dropColumn( 'updated_by' );
        });
    }
}
