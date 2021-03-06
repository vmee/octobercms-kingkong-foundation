<?php namespace Kingkong\Foundation\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateKingkongFoundationFavorites extends Migration
{
    public function up()
    {
        Schema::create('kingkong_foundation_favorites', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('favorite_id');
            $table->string('favorite_type');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('kingkong_foundation_favorites');
    }
}