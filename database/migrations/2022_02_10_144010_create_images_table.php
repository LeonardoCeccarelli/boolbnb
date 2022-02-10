<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->text("path");
            $table->string("alt")->nullable();

            $table->unsignedBigInteger("apartment_id");
            $table->foreign("apartment_id")
                ->references("id")
                ->on("apartments");

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
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign('images_apartment_id_foreign');
            $table->dropColumn('apartment_id');
        });
        Schema::dropIfExists('images');
    }
}
