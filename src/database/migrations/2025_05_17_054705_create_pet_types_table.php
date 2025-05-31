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
        Schema::create('pet_types', function (Blueprint $table) {
            $table->increments('pet_type_id')->comment('ペット種別ID');
            $table->string('name')->comment('ペット種別名');
            $table->boolean('delete_flg')->default(false)->comment('削除フラグ');
            $table->timestamps();

            $table->comment('ペット種別');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_types');
    }
};
