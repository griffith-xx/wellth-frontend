<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UserPreferenceController extends Controller
{
    public function create()
    {
        return Inertia::render('UserPreference');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // ส่วนที่ 1: ข้อมูลเป้าหมายสุขภาพ
            'health_goals' => 'required|array|min:1',
            'health_goals.*' => 'string|in:weight_loss,stress_relief,fitness,detox,rehabilitation,better_sleep,skin_care,immunity',
            'health_conditions' => 'required|array|min:1',
            'health_conditions.*' => 'string|in:diabetes,hypertension,back_pain,arthritis,insomnia,skin_problems,digestive_issues,none',
            'physical_activity_level' => 'required|string|in:low,low_moderate,moderate,high,very_high',

            // ส่วนที่ 2: ความสนใจด้านกิจกรรมเพื่อสุขภาพ
            'spa_treatments' => 'required|array|min:1',
            'spa_treatments.*' => 'string|in:thai_massage,aromatherapy,hot_stone,herbal_steam,body_scrub,facial_treatment,mineral_bath,mud_therapy,not_interested',
            'traditional_healing' => 'array',
            'traditional_healing.*' => 'string|in:thai_traditional_medicine,thai_herbal_medicine,herbal_compress,chinese_medicine,ayurveda,yoga_therapy,meditation_therapy,not_interested',
            'fitness_programs' => 'array',
            'fitness_programs.*' => 'string|in:yoga,pilates,muay_thai,fitness_camp,swimming,hiking,cycling,not_interested',

            // ส่วนที่ 3: ความชอบด้านการเดินทาง
            'preferred_regions' => 'required|array|min:1',
            'preferred_regions.*' => 'string|in:north,northeast,central,east,south_west,south_east',
            'accommodation_type' => 'required|string|in:health_resort,spa_hotel,retreat_center,health_homestay,regular_hotel',
            'budget_range' => 'required|string|in:budget,mid_range,luxury,premium',
            'trip_duration' => 'required|string|in:1-2_days,3-4_days,5-7_days,more_than_week',
            'travel_style' => 'required|string|in:solo,couple,family,group',

            // ส่วนที่ 4: ความชอบด้านสิ่งแวดล้อมและกิจกรรม
            'nature_preferences' => 'required|array|min:1',
            'nature_preferences.*' => 'string|in:mountain,beach,forest,waterfall,flower_field,hot_spring,national_park',
            'preferred_climate' => 'required|string|in:cool,warm,tropical_hot,sea_breeze,no_preference',
            'preferred_months' => 'required|array|min:1',
            'preferred_months.*' => 'string|in:jan_feb,mar_may,jun_aug,sep_oct,nov_dec,flexible',

            // ส่วนที่ 5: ความต้องการด้านอาหารและโภชนาการ
            'healthy_eating_interest' => 'required|integer|min:1|max:5',
            'dietary_preferences' => 'required|array|min:1',
            'dietary_preferences.*' => 'string|in:vegetarian,vegan,halal,organic,local_healthy,herbal_supplements,no_special_requirements',
            'food_restrictions' => 'required|array|min:1',
            'food_restrictions.*' => 'string|in:gluten_free,lactose_free,nut_allergy,diabetic,low_sodium,no_restrictions',

            // ส่วนที่ 6: การเข้าถึงและความต้องการพิเศษ
            'mobility_requirements' => 'required|array|min:1',
            'mobility_requirements.*' => 'string|in:wheelchair_accessible,elderly_friendly,child_friendly,elevator_access,no_special_needs',
            'language_preference' => 'required|string|in:thai,english,chinese,japanese,korean,not_important',
            'medical_support_needed' => 'required|string|in:required,not_required,unsure',

            // ส่วนที่ 7: ประสบการณ์และความคาดหวัง
            'previous_health_tourism' => 'required|string|in:never,once_twice,multiple_times,regularly',
            'previous_experience_highlights' => 'nullable|string|max:1000',
            'improvement_areas' => 'nullable|string|max:1000',
            'priority_factors' => 'required|array|min:1',
            'priority_factors.*' => 'string|in:health_results,value_for_money,service_safety,environment_atmosphere,travel_convenience',
            'social_interaction_level' => 'required|string|in:privacy_quiet,minimal_interaction,meet_new_people',
        ]);

        auth()->user()->userPreference()->create([
            'health_goals' => json_encode($validated['health_goals']),
            'health_conditions' => json_encode($validated['health_conditions']),
            'physical_activity_level' => $validated['physical_activity_level'],
            'spa_treatments' => json_encode($validated['spa_treatments']),
            'traditional_healing' => json_encode($validated['traditional_healing'] ?? []),
            'fitness_programs' => json_encode($validated['fitness_programs'] ?? []),
            'preferred_regions' => json_encode($validated['preferred_regions']),
            'accommodation_type' => $validated['accommodation_type'],
            'budget_range' => $validated['budget_range'],
            'trip_duration' => $validated['trip_duration'],
            'travel_style' => $validated['travel_style'],
            'nature_preferences' => json_encode($validated['nature_preferences']),
            'preferred_climate' => $validated['preferred_climate'],
            'preferred_months' => json_encode($validated['preferred_months']),
            'healthy_eating_interest' => $validated['healthy_eating_interest'],
            'dietary_preferences' => json_encode($validated['dietary_preferences']),
            'food_restrictions' => json_encode($validated['food_restrictions']),
            'mobility_requirements' => json_encode($validated['mobility_requirements']),
            'language_preference' => $validated['language_preference'],
            'medical_support_needed' => $validated['medical_support_needed'],
            'previous_health_tourism' => $validated['previous_health_tourism'],
            'previous_experience_highlights' => $validated['previous_experience_highlights'],
            'improvement_areas' => $validated['improvement_areas'],
            'priority_factors' => json_encode($validated['priority_factors']),
            'social_interaction_level' => $validated['social_interaction_level'],
        ]);

        return redirect()->route('dashboard')->with('flash', [
            'message' => 'บันถึกข้อมูลสำเร็จ',
            'style' => 'success',
        ]);
    }
}
