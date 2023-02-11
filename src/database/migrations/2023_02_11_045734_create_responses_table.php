<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('responses', function (Blueprint $table): void {
            $table->id();
            $table->morphs('reference');
            $table->string('method', 16);
            $table->text('url');
            $table->text('payload');
            $table->unsignedSmallInteger('status_code');
            $table->string('status_text');
            $table->text('contents');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
