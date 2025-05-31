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
        Schema::create('members', function (Blueprint $table) {
            $table->increments('member_id')->comment('メンバーID');
            $table->string('last_name')->comment('姓');
            $table->string('first_name')->comment('名');
            $table->date('birthday')->comment('生年月日');
            $table->string('email')->comment('メールアドレス');
            $table->string('password')->comment('パスワード');
            $table->char('zip_code', 7)->comment('郵便番号');
            $table->string('address')->comment('住所');
            $table->boolean('delete_flg')->default(false)->comment('削除フラグ');
            $table->timestamps();

            $table->comment('メンバー');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
