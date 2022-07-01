<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_variants', function (Blueprint $table) {
            $table->text("digital_download_assets")->nullable();
            $table->integer("digital_download_assets_count")->nullable();
            $table->integer("digital_download_assets_limit")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_variants', function (Blueprint $table) {
            $table->dropColumn("digital_download_assets");
            $table->dropColumn("digital_download_assets_count");
            $table->dropColumn("digital_download_assets_limit");
        });
    }
};
