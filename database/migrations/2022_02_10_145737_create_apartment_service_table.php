<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_service', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("apartment_id");
            $table->foreign("apartment_id")
                ->references("id")
                ->on("apartments");

            $table->unsignedBigInteger("service_id");
            $table->foreign("service_id")
                ->references("id")
                ->on("services");

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
        Schema::table('apartment_service', function (Blueprint $table) {
            $table->dropForeign('apartment_service_apartment_id_foreign');
            $table->dropColumn('apartment_id');
            $table->dropForeign('apartment_service_service_id_foreign');
            $table->dropColumn('service_id');
        });
        Schema::dropIfExists('apartment_service');
    }
}
