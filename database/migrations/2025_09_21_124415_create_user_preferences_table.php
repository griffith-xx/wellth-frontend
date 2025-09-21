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
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // ส่วนที่ 1: ข้อมูลเป้าหมายสุขภาพ
            $table->json('health_goals')->nullable();
            $table->json('health_conditions')->nullable();
            $table->enum('physical_activity_level', ['low', 'moderate', 'high', 'very_high'])->nullable();

            // ส่วนที่ 2: ความสนใจด้านกิจกรรมเพื่อสุขภาพ
            $table->json('spa_treatments')->nullable();
            $table->json('traditional_healing')->nullable();
            $table->json('fitness_programs')->nullable();

            // ส่วนที่ 3: ความชอบด้านการเดินทาง
            $table->json('preferred_regions')->nullable();
            $table->string('accommodation_type')->nullable();
            $table->enum('budget_range', ['budget', 'mid_range', 'luxury', 'premium'])->nullable();
            $table->string('trip_duration')->nullable();
            $table->enum('travel_style', ['solo', 'couple', 'family', 'group'])->nullable();

            // ส่วนที่ 4: ความชอบด้านสิ่งแวดล้อมและกิจกรรม
            $table->json('nature_preferences')->nullable();
            $table->string('preferred_climate')->nullable();
            $table->json('preferred_months')->nullable();

            // ส่วนที่ 5: ความต้องการด้านอาหารและโภชนาการ
            $table->integer('healthy_eating_interest')->default(0);
            $table->json('dietary_preferences')->nullable();
            $table->json('food_restrictions')->nullable();

            // ส่วนที่ 6: การเข้าถึงและความต้องการพิเศษ
            $table->json('mobility_requirements')->nullable();
            $table->enum('language_preference', ['thai', 'english', 'chinese', 'japanese', 'korean'])->default('thai');
            $table->string('medical_support_needed')->nullable();

            // ส่วนที่ 7: ประสบการณ์และความคาดหวัง
            $table->string('previous_health_tourism')->nullable();
            $table->text('previous_experience_highlights')->nullable();
            $table->text('improvement_areas')->nullable();
            $table->json('priority_factors')->nullable();
            $table->string('social_interaction_level')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
