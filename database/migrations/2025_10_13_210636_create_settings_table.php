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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('system_name');
            $table->string('description');
            $table->string('branch_store');
            $table->text('address');
            $table->string('phone_number');
            $table->string('logo');
            $table->string('image_login');
            $table->string('email');
            $table->string('currency');//divisa
            $table->string('web_site')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
