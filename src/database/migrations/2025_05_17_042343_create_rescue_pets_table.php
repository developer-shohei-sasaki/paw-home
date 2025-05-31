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
        Schema::create('rescue_pets', function (Blueprint $table) {
            $table->increments('rescue_pets_id')->comment('ペットID');
            $table->integer('pet_type_id')->comment('ペット種別ID');
            $table->integer('pet_type_detail_id')->comment('ペット詳細種別ID');
            $table->integer('gender_id')->comment('性別ID');
            $table->binary('picture')->comment('写真');
            $table->string('name')->comment('ペット名');
            $table->date('birthday')->comment('誕生日');
            $table->string('self_introduction')->comment('自己紹介');
            $table->integer('transfer_price')->comment('譲渡費用');
            $table->boolean('delete_flg')->default(false)->comment('削除フラグ');
            $table->timestamps();

            $table->comment('保護ペット');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rescue_pets');
    }
};
