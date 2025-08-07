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
        if (!Schema::hasTable('app_uploads')) {
            Schema::create('app_uploads', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable();
                $table->foreignId('company_id')->nullable();
                $table->foreignId('app_id')->nullable();
                $table->string('apk_version')->nullable();
                $table->integer('download')->nullable();
                $table->text('apk')->nullable();
                $table->string('apk_status')->default('Draft');
                $table->string('status')->default('Draft');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_uploads');
    }
};
