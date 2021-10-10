<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('meal_category_id')
                ->constrained('meal_categories')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->text('detail');
            $table->string('image');
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_posts');
    }
}
