<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import {
    Stepper,
    StepItem,
    Step,
    StepPanel,
    Button,
    Checkbox,
    RadioButton,
    InputText,
} from "primevue";
import {
    healthGoalsOptions,
    healthConditionsOptions,
    physicalActivitiesOptions,
    spaTreatmentsOptions,
    traditionalHealingOptions,
    fitnessProgramsOptions,
    preferredRegionsOptions,
    accommodationTypeOptions,
    budgetRangeOptions,
    tripDurationOptions,
    travelStyleOptions,
    naturePreferencesOptions,
    preferredClimateOptions,
    preferredMonthsOptions,
    healthyEatingInterestOptions,
    dietaryPreferencesOptions,
    foodRestrictionsOptions,
    mobilityRequirementsOptions,
    languagePreferenceOptions,
    medicalSupportOptions,
    previousHealthTourismOptions,
    priorityFactorsOptions,
    socialInteractionOptions,
} from "@/Const/userPreferenceOptions";

const form = useForm({
    // ส่วนที่ 1: ข้อมูลเป้าหมายสุขภาพ
    health_goals: ["stress_relief", "fitness"],
    health_conditions: ["back_pain"],
    physical_activity_level: "moderate",

    // ส่วนที่ 2: ความสนใจด้านกิจกรรมเพื่อสุขภาพ
    spa_treatments: ["thai_massage", "aromatherapy"],
    traditional_healing: ["herbal_compress", "yoga_therapy"],
    fitness_programs: ["yoga", "swimming"],

    // ส่วนที่ 3: ความชอบด้านการเดินทาง
    preferred_regions: ["north", "central"],
    accommodation_type: "health_resort",
    budget_range: "mid_range",
    trip_duration: "3-4_days",
    travel_style: "couple",

    // ส่วนที่ 4: ความชอบด้านสิ่งแวดล้อมและกิจกรรม
    nature_preferences: ["mountain", "hot_spring"],
    preferred_climate: "cool",
    preferred_months: ["nov_dec"],

    // ส่วนที่ 5: ความต้องการด้านอาหารและโภชนาการ
    healthy_eating_interest: "4",
    dietary_preferences: ["organic", "local_healthy"],
    food_restrictions: ["no_restrictions"],

    // ส่วนที่ 6: การเข้าถึงและความต้องการพิเศษ
    mobility_requirements: ["no_special_needs"],
    language_preference: "thai",
    medical_support_needed: "not_required",

    // ส่วนที่ 7: ประสบการณ์และความคาดหวัง
    previous_health_tourism: "once_twice",
    previous_experience_highlights: "นวดแผนไทยและบรรยากาศที่ผ่อนคลาย",
    improvement_areas: "ต้องการกิจกรรมที่หลากหลายมากขึ้น",
    priority_factors: ["health_results", "service_safety"],
    social_interaction_level: "minimal_interaction",
});

const submit = () => {
    form.post(route("user-preferences.store"));
};
</script>

<template>
    <AppLayout title="กรอกแบบสอบถาม">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <h1 class="font-bold text-3xl mb-4">
                🏥 แบบสำรวจความต้องการท่องเที่ยวเพื่อสุขภาพ
            </h1>
            <Stepper value="1">
                <StepItem value="1">
                    <Step>ส่วนที่ 1: ข้อมูลเป้าหมายสุขภาพ 🎯</Step>
                    <StepPanel v-slot="{ activateCallback }">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    1.1 เป้าหมายสุขภาพหลักของคุณคืออะไร?
                                    (เลือกได้หลายข้อ)
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in healthGoalsOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <Checkbox
                                        name="health_goals"
                                        v-model="form.health_goals"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    1.2
                                    คุณมีปัญหาสุขภาพเฉพาะใดที่ต้องการดูแลเป็นพิเศษ?
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in healthConditionsOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <Checkbox
                                        name="health_conditions"
                                        v-model="form.health_conditions"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    1.3 ระดับการออกกำลังกายปกติของคุณ?
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in physicalActivitiesOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <RadioButton
                                        name="physical_activity_level"
                                        v-model="form.physical_activity_level"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="py-6">
                            <Button
                                label="ถัดไป"
                                @click="activateCallback('2')"
                            />
                        </div>
                    </StepPanel>
                </StepItem>
                <StepItem value="2">
                    <Step>ส่วนที่ 2: ความสนใจด้านกิจกรรมเพื่อสุขภาพ 💆‍♀️</Step>
                    <StepPanel v-slot="{ activateCallback }">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    2.1 กิจกรรมสปาและความงามที่สนใจ
                                    (เลือกได้หลายข้อ)
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in spaTreatmentsOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <Checkbox
                                        name="spa_treatments"
                                        v-model="form.spa_treatments"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    2.2 การรักษาแผนไทย/ทางเลือกที่สนใจ
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in traditionalHealingOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <Checkbox
                                        name="traditional_healing"
                                        v-model="form.traditional_healing"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    โปรแกรมออกกำลังกาย/ฟิตเนสที่สนใจ
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in fitnessProgramsOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <Checkbox
                                        name="fitness_programs"
                                        v-model="form.fitness_programs"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="flex py-6 gap-2">
                            <Button
                                label="ย้อนกลับ"
                                severity="secondary"
                                icon="pi pi-arrow-left"
                                @click="activateCallback('1')"
                            />
                            <Button
                                label="ถัดไป"
                                @click="activateCallback('3')"
                            />
                        </div>
                    </StepPanel>
                </StepItem>
                <StepItem value="3">
                    <Step>ส่วนที่ 3: ความชอบด้านการเดินทาง ✈️</Step>
                    <StepPanel v-slot="{ activateCallback }">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    3.1 ภูมิภาคในประเทศไทยที่ชอบ/สนใจ
                                    (เลือกได้หลายข้อ)
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in preferredRegionsOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <Checkbox
                                        name="preferred_regions"
                                        v-model="form.preferred_regions"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    3.2 ประเภทที่พักที่ต้องการ
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in accommodationTypeOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <RadioButton
                                        name="accommodation_type"
                                        v-model="form.accommodation_type"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    3.3 งบประมาณต่อคน (ต่อการเดินทาง)
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in budgetRangeOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <RadioButton
                                        name="budget_range"
                                        v-model="form.budget_range"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    3.4 ระยะเวลาเดินทางที่ต้องการ
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in tripDurationOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <RadioButton
                                        name="trip_duration"
                                        v-model="form.trip_duration"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    3.5 รูปแบบการเดินทาง
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in travelStyleOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <RadioButton
                                        name="travel_style"
                                        v-model="form.travel_style"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="flex py-6 gap-2">
                            <Button
                                label="ย้อนกลับ"
                                severity="secondary"
                                icon="pi pi-arrow-left"
                                @click="activateCallback('2')"
                            />
                            <Button
                                label="ถัดไป"
                                @click="activateCallback('4')"
                            />
                        </div>
                    </StepPanel>
                </StepItem>
                <StepItem value="4">
                    <Step>ส่วนที่ 4: ความชอบด้านสิ่งแวดล้อมและกิจกรรม 🌿</Step>
                    <StepPanel v-slot="{ activateCallback }">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    4.1 ธรรมชาติที่ชื่นชอบ (เลือกได้หลายข้อ)
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in naturePreferencesOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <Checkbox
                                        name="nature_preferences"
                                        v-model="form.nature_preferences"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    4.2 สภาพอากาศที่ชอบ
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in preferredClimateOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <RadioButton
                                        name="preferred_climate"
                                        v-model="form.preferred_climate"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    4.3 ช่วงเวลาที่สนใจเดินทาง (เลือกได้หลายข้อ)
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in preferredMonthsOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <Checkbox
                                        name="preferred_months"
                                        v-model="form.preferred_months"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="flex py-6 gap-2">
                            <Button
                                label="ย้อนกลับ"
                                severity="secondary"
                                icon="pi pi-arrow-left"
                                @click="activateCallback('3')"
                            />
                            <Button
                                label="ถัดไป"
                                @click="activateCallback('5')"
                            />
                        </div>
                    </StepPanel>
                </StepItem>
                <StepItem value="5">
                    <Step>ส่วนที่ 5: ความต้องการด้านอาหารและโภชนาการ 🥗</Step>
                    <StepPanel v-slot="{ activateCallback }">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    5.1 ความสนใจในอาหารเพื่อสุขภาพ (1-5 คะแนน)
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in healthyEatingInterestOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <Checkbox
                                        name="healthy_eating_interest"
                                        v-model="form.healthy_eating_interest"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    5.2 ความต้องการด้านอาหาร (เลือกได้หลายข้อ)
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in dietaryPreferencesOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <Checkbox
                                        name="dietary_preferences"
                                        v-model="form.dietary_preferences"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    5.3 ข้อจำกัดด้านอาหาร
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in foodRestrictionsOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <Checkbox
                                        name="food_restrictions"
                                        v-model="form.food_restrictions"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="flex py-6 gap-2">
                            <Button
                                label="ย้อนกลับ"
                                severity="secondary"
                                icon="pi pi-arrow-left"
                                @click="activateCallback('4')"
                            />
                            <Button
                                label="ถัดไป"
                                @click="activateCallback('6')"
                            />
                        </div>
                    </StepPanel>
                </StepItem>
                <StepItem value="6">
                    <Step>ส่วนที่ 6: การเข้าถึงและความต้องการพิเศษ ♿</Step>
                    <StepPanel v-slot="{ activateCallback }">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    6.1 ความต้องการด้านการเข้าถึง
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in mobilityRequirementsOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <Checkbox
                                        name="mobility_requirements"
                                        v-model="form.mobility_requirements"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    6.2 ความสามารถด้านภาษา
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in languagePreferenceOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <RadioButton
                                        name="language_preference"
                                        v-model="form.language_preference"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    6.3 ต้องการการสนับสนุนทางการแพทย์หรือไม่?
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in medicalSupportOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <RadioButton
                                        name="medical_support_needed"
                                        v-model="form.medical_support_needed"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="flex py-6 gap-2">
                            <Button
                                label="ย้อนกลับ"
                                severity="secondary"
                                icon="pi pi-arrow-left"
                                @click="activateCallback('5')"
                            />
                            <Button
                                label="ถัดไป"
                                @click="activateCallback('7')"
                            />
                        </div>
                    </StepPanel>
                </StepItem>
                <StepItem value="7">
                    <Step>ส่วนที่ 7: ประสบการณ์และความคาดหวัง 📝</Step>
                    <StepPanel v-slot="{ activateCallback }">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    7.1 เคยไปท่องเที่ยวเพื่อสุขภาพมาก่อนหรือไม่?
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in previousHealthTourismOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <RadioButton
                                        name="previous_health_tourism"
                                        v-model="form.previous_health_tourism"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>

                                <div class="flex items-center gap-2">
                                    <label for="previous_experience_highlights">
                                        หากเคย ประทับใจอะไรมากที่สุด:
                                    </label>
                                    <InputText
                                        class="w-100"
                                        size="small"
                                        name="previous_experience_highlights"
                                        v-model="
                                            form.previous_experience_highlights
                                        "
                                    />
                                </div>
                                <div class="flex items-center gap-2">
                                    <label for="improvement_areas"
                                        >อยากให้ปรับปรุงอะไร:</label
                                    >
                                    <InputText
                                        class="w-100"
                                        size="small"
                                        name="improvement_areas"
                                        v-model="form.improvement_areas"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    7.2 ปัจจัยที่สำคัญที่สุดสำหรับคุณ
                                    (เรียงลำดับ 1-5)
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in priorityFactorsOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <Checkbox
                                        name="priority_factors"
                                        v-model="form.priority_factors"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2">
                                <h1 class="font-semibold">
                                    7.3 ระดับการมีปฏิสัมพันธ์ทางสังคมที่ต้องการ
                                </h1>
                                <div
                                    v-for="(
                                        option, index
                                    ) in socialInteractionOptions"
                                    :key="index"
                                    class="flex items-center gap-2"
                                >
                                    <RadioButton
                                        name="social_interaction_level"
                                        v-model="form.social_interaction_level"
                                        :inputId="option.value"
                                        :value="option.value"
                                    />
                                    <label :for="option.value">
                                        {{ option.label }}
                                    </label>
                                </div>
                            </div>

                            <p class="mt-4 font-semibold">
                                ขอบคุณสำหรับเวลาที่ใช้กรอกแบบสำรวจ
                                ข้อมูลจะถูกใช้เพื่อคัดสรรแนะนำสถานที่ท่องเที่ยวเพื่อสุขภาพที่เหมาะสมที่สุดสำหรับคุณ
                                ❤️
                            </p>
                        </div>
                        <div class="flex py-6 gap-2">
                            <Button
                                label="ย้อนกลับ"
                                severity="secondary"
                                icon="pi pi-arrow-left"
                                @click="activateCallback('6')"
                            />
                            <Button label="ถัดไป" @click="submit" />
                        </div>
                    </StepPanel>
                </StepItem>
            </Stepper>
        </div>
    </AppLayout>
</template>
