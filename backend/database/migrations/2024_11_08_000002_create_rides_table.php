<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Driver;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Driver::class)->nullable()->constrained()->onDelete('cascade');
            $table->boolean('is_started')->default(false);
            $table->boolean('is_complete')->default(false);
            $table->decimal('pickup_lat', 10, 8)->nullable();
            $table->decimal('pickup_lng', 11, 8)->nullable();
            $table->json('origin')->nullable();
            $table->json('destination')->nullable();
            $table->string('destination_name')->nullable();
            $table->json('driver_location')->nullable();
            $table->enum('status', ['pending', 'started', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('rides');
        Schema::enableForeignKeyConstraints();
    }
};