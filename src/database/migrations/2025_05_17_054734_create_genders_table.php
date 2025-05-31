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
        Schema::create('genders', function (Blueprint $table) {
            $table->increments('gender_id')->comment('性別ID');
            $table->string('name')->comment('性別名');
            $table->boolean('delete_flg')->default(false)->comment('削除フラグ');
            $table->timestamps();

            $table->comment('性別');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genders');
    }
};
