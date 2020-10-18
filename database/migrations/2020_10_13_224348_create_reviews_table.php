<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('comment',100000)->nullable()->comment('コメント');
            $table->unsignedTinyInteger('cozy_point')->comment('評価点:居心地の良さ');
            $table->unsignedTinyInteger('price_point')->comment('評価点:価格');
            $table->unsignedTinyInteger('age_group_point')->comment('評価点:年齢層');
            $table->unsignedTinyInteger('access_point')->comment('評価点:アクセスの良さ');
            $table->unsignedTinyInteger('concentration_point')->comment('評価点:集中度');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('place_id')->constrained('places');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
