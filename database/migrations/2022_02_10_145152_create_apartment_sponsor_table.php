<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentSponsorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_sponsor', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("apartment_id");
            $table->foreign("apartment_id")
                ->references("id")
                ->on("apartments");

            $table->unsignedBigInteger("sponsor_id");
            $table->foreign("sponsor_id")
                ->references("id")
                ->on("sponsor");

            $table->dateTime("starting_date");
            $table->dateTime("end_date");

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
        Schema::table('apartment_sponsor', function (Blueprint $table) {
            $table->dropForeign('apartment_sponsor_apartment_id_foreign');
            $table->dropColumn('apartment_id');
            $table->dropForeign('apartment_sponsor_sponsor_id_foreign');
            $table->dropColumn('sponsor_id');
        });
        Schema::dropIfExists('apartment_sponsor');
    }
}
