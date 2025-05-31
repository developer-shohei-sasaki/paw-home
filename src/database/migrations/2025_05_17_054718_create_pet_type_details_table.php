<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pet_type_details', function (Blueprint $table) {
            $table->increments('pet_type_detail_id')->comment('ペット種別詳細ID');
            $table->integer('pet_type_id')->comment('ペット種別ID');
            $table->string('name')->comment('ペット詳細種別名');
            $table->boolean('delete_flg')->default(false)->comment('削除フラグ');
            $table->timestamps();

            $table->comment('ペット種別詳細');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_type_details');
    }
};
