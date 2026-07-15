<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('about_pages')) {
            return;
        }

        DB::statement('ALTER TABLE about_pages MODIFY hero_paragraphs LONGTEXT NULL');

        $rows = DB::table('about_pages')->get();

        foreach ($rows as $row) {
            $value = $row->hero_paragraphs;

            if ($value === null || $value === '') {
                continue;
            }

            $decoded = json_decode($value, true);

            if (!is_array($decoded)) {
                continue;
            }

            $html = collect($decoded)
                ->filter(fn ($paragraph) => trim((string) $paragraph) !== '')
                ->map(fn ($paragraph) => '<p>' . e($paragraph) . '</p>')
                ->implode('');

            DB::table('about_pages')
                ->where('id', $row->id)
                ->update(['hero_paragraphs' => $html]);
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('about_pages')) {
            return;
        }

        DB::statement('ALTER TABLE about_pages MODIFY hero_paragraphs JSON NULL');
    }
};
