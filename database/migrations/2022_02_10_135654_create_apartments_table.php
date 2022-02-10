<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description");
            $table->text("cover_img")->nullable();
            $table->integer("rooms");
            $table->integer("beds");
            $table->integer("bathrooms");
            $table->integer("square_metres")->nullable();
            $table->float("night_price", 6, 2);
            $table->text("address");
            $table->string("city");
            $table->string("lat");
            $table->string("lon");
            $table->boolean("visible");

            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")
                ->references("id")
                ->on("users");

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
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropForeign('apartments_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('apartments');
    }
}
