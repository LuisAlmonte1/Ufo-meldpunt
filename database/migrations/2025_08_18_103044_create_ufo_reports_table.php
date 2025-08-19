<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('ufo_reports', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        $table->string('reporter_name')->nullable();
        $table->string('reporter_email')->nullable();
        $table->datetime('incident_datetime');
        $table->string('location');
        $table->text('description');
        $table->enum('category', ['licht', 'object', 'ontmoeting', 'geluid', 'anders']);
        $table->string('photo_path')->nullable();
        $table->enum('status', ['nieuw', 'in_behandeling', 'opgelost', 'gesloten'])->default('nieuw');
        $table->boolean('is_paid')->default(false);
        $table->decimal('support_fee', 8, 2)->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ufo_reports');
    }
};
