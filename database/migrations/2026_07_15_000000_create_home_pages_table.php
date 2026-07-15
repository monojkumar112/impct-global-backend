<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();

            $table->string('hero_badge')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_tagline')->nullable();
            $table->string('hero_primary_btn_text')->nullable();
            $table->string('hero_primary_btn_link')->nullable();
            $table->string('hero_secondary_btn_text')->nullable();
            $table->string('hero_secondary_btn_link')->nullable();
            $table->string('hero_map_label')->nullable();
            $table->json('hero_priorities')->nullable();
            $table->string('hero_image')->nullable();

            $table->string('who_title')->nullable();
            $table->text('who_description')->nullable();
            $table->string('who_btn_text')->nullable();
            $table->string('who_btn_link')->nullable();
            $table->string('who_image')->nullable();

            $table->string('story_label')->nullable();
            $table->string('story_title')->nullable();
            $table->text('story_description')->nullable();
            $table->json('story_features')->nullable();
            $table->string('story_btn_text')->nullable();
            $table->string('story_btn_link')->nullable();
            $table->string('story_image')->nullable();
            $table->text('story_quote')->nullable();
            $table->string('story_quote_author')->nullable();

            $table->string('why_title')->nullable();
            $table->text('why_description')->nullable();
            $table->json('why_items')->nullable();

            $table->string('join_badge')->nullable();
            $table->string('join_title')->nullable();
            $table->text('join_description')->nullable();
            $table->string('join_primary_btn_text')->nullable();
            $table->string('join_primary_btn_link')->nullable();
            $table->string('join_secondary_btn_text')->nullable();
            $table->string('join_secondary_btn_link')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
