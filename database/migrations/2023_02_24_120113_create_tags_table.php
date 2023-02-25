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
        Schema::create('tags', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            // timestampと書いてしまうと、レコード挿入時、更新時に値が入らないので、DB::rawで直接書いてます
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('user_id')->references('id')->on('users');
            // //　桁数の多い数値 , unsignを付けると符号なしになる
            // $table->unsignedBigInteger('id', true);
            // $table->string('name');
            // $table->unsignedBigInteger('user_id');
            // // 論理削除 - deleted-atを自動生成 : いつでも削除機能を実装できるように
            // $table->softDeletes();
            // $table->timestamp('updated_at')->default(\DB::raw('CUREENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            // $table->timestamp('create_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            // // 外部キー制約 : user_idとusersテーブル内のidは一致している必要があるという意味
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
