<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->string('license_number')->unique()->nullable();
            $table->json('vehicle_info')->nullable();
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->integer('total_rides')->default(0);
            $table->foreignId('current_ride_id')->nullable()->constrained('rides')->nullOnDelete();
            $table->point('last_location');
            $table->timestamp('last_location_updated_at')->nullable();
            $table->timestamps();
            $table->index('last_location');
        });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('drivers');
        Schema::enableForeignKeyConstraints();
    }
};