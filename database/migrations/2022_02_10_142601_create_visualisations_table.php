<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisualisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visualisations', function (Blueprint $table) {
            $table->id();
            $table->dateTime("date");
            $table->ipAddress("ip_address");

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
        Schema::table('visualisations', function (Blueprint $table) {
            $table->dropForeign('visualisations_apartment_id_foreign');
            $table->dropColumn('apartment_id');
        });
        Schema::dropIfExists('visualisations');
    }
}
