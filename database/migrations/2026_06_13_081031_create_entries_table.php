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
    Schema::create('entries', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
        $table->string('title');
        $table->text('content');
        $table->enum('mood', ['happy', 'neutral', 'sad', 'angry', 'sleepy'])->default('neutral');
        $table->string('image_path')->nullable();
        $table->date('entry_date');
        $table->timestamps();
    });
}
};
