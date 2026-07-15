<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_badge')->nullable();
            $table->string('page_title')->nullable();
            $table->string('card_badge')->nullable();
            $table->string('card_title')->nullable();
            $table->text('card_description')->nullable();
            $table->string('email_label')->nullable();
            $table->string('email')->nullable();
            $table->string('office_label')->nullable();
            $table->text('office_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_pages');
    }
};
