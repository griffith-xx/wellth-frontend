<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { Button, Card, Carousel, Divider } from "primevue";

// Sample data for carousel
const featuredDestinations = [
    {
        id: 1,
        name: "เชียงใหม่",
        image: "https://plus.unsplash.com/premium_photo-1661929242720-140374d97c94?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        description: "สปาแผนไทย และการนวดแบบดั้งเดิม",
        highlights: ["นวดแผนไทย", "สมุนไพรท้องถิิน", "อากาศบริสุทธิ์"],
    },
    {
        id: 2,
        name: "เกาะสมุย",
        image: "https://images.unsplash.com/photo-1572529593091-6c05c37cacc7?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        description: "รีสอร์ทสุขภาพริมทะเล",
        highlights: ["โยคะริมชายหาด", "ดีท็อกซ์", "อาหารเพื่อสุขภาพ"],
    },
    {
        id: 3,
        name: "หัวหิน",
        image: "https://images.unsplash.com/photo-1541738158050-3f1568a657a5?q=80&w=1105&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
        description: "สปาหรูหราและการรักษาแบบองค์รวม",
        highlights: ["สปาระดับโลก", "การรักษาแบบองค์รวม", "ใกล้กรุงเทพฯ"],
    },
];

const healthBenefits = [
    {
        icon: "pi pi-heart",
        title: "ผ่อนคลายความเครียด",
        description: "กิจกรรมสปาและการนวดเพื่อลดความตึงเครียด",
    },
    {
        icon: "pi pi-sun",
        title: "ฟื้นฟูร่างกาย",
        description: "โปรแกรมออกกำลังกายและการรักษาแบบธรรมชาติ",
    },
    {
        icon: "pi pi-apple",
        title: "ดีท็อกซ์ธรรมชาติ",
        description: "อาหารเพื่อสุขภาพและสมุนไพรไทย",
    },
    {
        icon: "pi pi-map",
        title: "เชื่อมต่อกับธรรมชาติ",
        description: "สัมผัสธรรมชาติและวัฒนธรรมไทยแท้",
    },
];

const testimonials = [
    {
        name: "คุณสมใจ",
        location: "กรุงเทพฯ",
        rating: 5,
        comment:
            "ประสบการณ์ที่ยอดเยี่ยม! สปาที่เชียงใหม่ช่วยให้ฉันผ่อนคลายและฟื้นฟูพลังงานได้อย่างสมบูรณ์",
    },
    {
        name: "คุณมาลี",
        location: "ขอนแก่น",
        rating: 5,
        comment:
            "โปรแกรมดีท็อกซ์ที่เกาะสมุยเปลี่ยนชีวิตฉันไปเลย รู้สึกสดชื่นและมีพลังมากขึ้น",
    },
    {
        name: "คุณวิชัย",
        location: "เชียงราย",
        rating: 5,
        comment:
            "การรักษาแบบองค์รวมที่หัวหินช่วยแก้ปัญหาปวดหลังที่เป็นมานาน แนะนำเลยครับ",
    },
];
</script>

<template>
    <Head title="Wellth - ท่องเที่ยวเพื่อสุขภาพในไทย" />

    <!-- Hero Section -->
    <section
        class="relative min-h-screen bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 flex items-center"
    >
        <div
            class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=1920')] bg-cover bg-center opacity-10"
        ></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl font-bold text-gray-900 mb-6">
                    <span class="text-emerald-600">Wellth</span>
                    <br />
                    <span
                        class="text-3xl md:text-4xl font-medium text-gray-700"
                    >
                        ท่องเที่ยวเพื่อสุขภาพในไทย
                    </span>
                </h1>
                <p
                    class="text-xl md:text-2xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed"
                >
                    ค้นพบประสบการณ์ท่องเที่ยวเพื่อสุขภาพที่เหมาะกับคุณ
                    พร้อมคำแนะนำส่วนบุคคลจากปัญญาประดิษฐ์
                </p>
                <div
                    class="flex flex-col sm:flex-row gap-4 justify-center items-center"
                >
                    <Link :href="route('user-preferences.create')">
                        <Button label="เริ่มต้นการเดินทาง" size="large" />
                    </Link>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    ทำไมต้องเลือก Wellth?
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    เราใช้เทคโนโลยี AI
                    เพื่อแนะนำสถานที่ท่องเที่ยวเพื่อสุขภาพที่เหมาะกับคุณมากที่สุด
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div
                    v-for="benefit in healthBenefits"
                    :key="benefit.title"
                    class="text-center group"
                >
                    <div
                        class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-emerald-200 transition-colors duration-300"
                    >
                        <i
                            :class="benefit.icon"
                            class="text-3xl text-emerald-600"
                        ></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        {{ benefit.title }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ benefit.description }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    จุดหมายยอดนิยม
                </h2>
                <p class="text-xl text-gray-600">
                    สถานที่ท่องเที่ยวเพื่อสุขภาพที่ได้รับความนิยมสูงสุด
                </p>
            </div>

            <Carousel
                :value="featuredDestinations"
                :numVisible="3"
                :numScroll="1"
                :responsiveOptions="[
                    { breakpoint: '1024px', numVisible: 2, numScroll: 1 },
                    { breakpoint: '768px', numVisible: 1, numScroll: 1 },
                ]"
                class="custom-carousel"
            >
                <template #item="slotProps">
                    <Card
                        class="m-4 shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden"
                    >
                        <template #header>
                            <img
                                :src="slotProps.data.image"
                                :alt="slotProps.data.name"
                                class="w-full h-48 object-cover"
                            />
                        </template>
                        <template #title>
                            <h3 class="text-2xl font-bold text-gray-900">
                                {{ slotProps.data.name }}
                            </h3>
                        </template>
                        <template #content>
                            <p class="text-gray-600 mb-4">
                                {{ slotProps.data.description }}
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <span
                                    v-for="highlight in slotProps.data
                                        .highlights"
                                    :key="highlight"
                                    class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium"
                                >
                                    {{ highlight }}
                                </span>
                            </div>
                        </template>
                        <template #footer>
                            <Button
                                label="ดูรายละเอียด"
                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white"
                            />
                        </template>
                    </Card>
                </template>
            </Carousel>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    วิธีการใช้งาน
                </h2>
                <p class="text-xl text-gray-600">
                    เพียง 3 ขั้นตอนง่ายๆ
                    เพื่อค้นหาการเดินทางเพื่อสุขภาพที่เหมาะกับคุณ
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-emerald-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-bold"
                    >
                        1
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        กรอกแบบสอบถาม
                    </h3>
                    <p class="text-gray-600">
                        บอกเราเกี่ยวกับเป้าหมายสุขภาพและความชอบของคุณ
                    </p>
                </div>

                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-emerald-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-bold"
                    >
                        2
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        รับคำแนะนำ
                    </h3>
                    <p class="text-gray-600">
                        AI จะวิเคราะห์และแนะนำสถานที่ที่เหมาะกับคุณ
                    </p>
                </div>

                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-emerald-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-bold"
                    >
                        3
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">
                        เริ่มการเดินทาง
                    </h3>
                    <p class="text-gray-600">
                        จองและเริ่มต้นประสบการณ์ท่องเที่ยวเพื่อสุขภาพ
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-emerald-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    เสียงจากผู้ใช้งาน
                </h2>
                <p class="text-xl text-gray-600">
                    ประสบการณ์จริงจากผู้ที่ได้รับประโยชน์จากการท่องเที่ยวเพื่อสุขภาพ
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <Card
                    v-for="testimonial in testimonials"
                    :key="testimonial.name"
                    class="shadow-lg"
                >
                    <template #content>
                        <div class="text-center">
                            <div class="flex justify-center mb-4">
                                <i
                                    v-for="n in testimonial.rating"
                                    :key="n"
                                    class="pi pi-star-fill text-yellow-400 text-lg"
                                ></i>
                            </div>
                            <p
                                class="text-gray-600 italic mb-6 leading-relaxed"
                            >
                                "{{ testimonial.comment }}"
                            </p>
                            <div class="border-t pt-4">
                                <h4 class="font-semibold text-gray-900">
                                    {{ testimonial.name }}
                                </h4>
                                <p class="text-sm text-gray-500">
                                    {{ testimonial.location }}
                                </p>
                            </div>
                        </div>
                    </template>
                </Card>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="py-20 bg-emerald-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 text-center text-white">
                <div>
                    <div class="text-4xl font-bold mb-2">500+</div>
                    <div class="text-emerald-100">สถานที่ท่องเที่ยว</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">10,000+</div>
                    <div class="text-emerald-100">ผู้ใช้งานที่พึงพอใจ</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">77</div>
                    <div class="text-emerald-100">จังหวัดทั่วไทย</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">95%</div>
                    <div class="text-emerald-100">ความพึงพอใจ</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Health Tourism Categories -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    ประเภทการท่องเที่ยวเพื่อสุขภาพ
                </h2>
                <p class="text-xl text-gray-600">
                    เลือกประเภทที่ตรงกับความต้องการของคุณ
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <Card
                    class="hover:shadow-xl transition-shadow duration-300 cursor-pointer group"
                >
                    <template #header>
                        <div
                            class="bg-gradient-to-r from-pink-400 to-pink-600 h-32 flex items-center justify-center"
                        >
                            <i class="pi pi-heart text-4xl text-white"></i>
                        </div>
                    </template>
                    <template #title>
                        <h3
                            class="text-xl font-semibold text-gray-900 group-hover:text-pink-600 transition-colors"
                        >
                            สปาและความงาม
                        </h3>
                    </template>
                    <template #content>
                        <p class="text-gray-600">
                            นวดแผนไทย, ทรีทเมนต์ผิว, และการดูแลความงามแบบองค์รวม
                        </p>
                    </template>
                </Card>

                <Card
                    class="hover:shadow-xl transition-shadow duration-300 cursor-pointer group"
                >
                    <template #header>
                        <div
                            class="bg-gradient-to-r from-green-400 to-green-600 h-32 flex items-center justify-center"
                        >
                            <i class="pi pi-plus text-4xl text-white"></i>
                        </div>
                    </template>
                    <template #title>
                        <h3
                            class="text-xl font-semibold text-gray-900 group-hover:text-green-600 transition-colors"
                        >
                            การรักษาแผนไทย
                        </h3>
                    </template>
                    <template #content>
                        <p class="text-gray-600">
                            สมุนไพรไทย, การรักษาแบบดั้งเดิม,
                            และการบำบัดด้วยธรรมชาติ
                        </p>
                    </template>
                </Card>

                <Card
                    class="hover:shadow-xl transition-shadow duration-300 cursor-pointer group"
                >
                    <template #header>
                        <div
                            class="bg-gradient-to-r from-blue-400 to-blue-600 h-32 flex items-center justify-center"
                        >
                            <i class="pi pi-bolt text-4xl text-white"></i>
                        </div>
                    </template>
                    <template #title>
                        <h3
                            class="text-xl font-semibold text-gray-900 group-hover:text-blue-600 transition-colors"
                        >
                            ฟิตเนสและโยคะ
                        </h3>
                    </template>
                    <template #content>
                        <p class="text-gray-600">
                            โปรแกรมออกกำลังกาย, โยคะ, และกิจกรรมเพื่อสุขภาพ
                        </p>
                    </template>
                </Card>

                <Card
                    class="hover:shadow-xl transition-shadow duration-300 cursor-pointer group"
                >
                    <template #header>
                        <div
                            class="bg-gradient-to-r from-purple-400 to-purple-600 h-32 flex items-center justify-center"
                        >
                            <i class="pi pi-moon text-4xl text-white"></i>
                        </div>
                    </template>
                    <template #title>
                        <h3
                            class="text-xl font-semibold text-gray-900 group-hover:text-purple-600 transition-colors"
                        >
                            การพักผ่อนและสมาธิ
                        </h3>
                    </template>
                    <template #content>
                        <p class="text-gray-600">
                            ทำสมาธิ, การพักผ่อน, และกิจกรรมเพื่อความสงบใจ
                        </p>
                    </template>
                </Card>

                <Card
                    class="hover:shadow-xl transition-shadow duration-300 cursor-pointer group"
                >
                    <template #header>
                        <div
                            class="bg-gradient-to-r from-orange-400 to-orange-600 h-32 flex items-center justify-center"
                        >
                            <i class="pi pi-apple text-4xl text-white"></i>
                        </div>
                    </template>
                    <template #title>
                        <h3
                            class="text-xl font-semibold text-gray-900 group-hover:text-orange-600 transition-colors"
                        >
                            โภชนาการและดีท็อกซ์
                        </h3>
                    </template>
                    <template #content>
                        <p class="text-gray-600">
                            อาหารเพื่อสุขภาพ, โปรแกรมดีท็อกซ์,
                            และการปรับสมดุลร่างกาย
                        </p>
                    </template>
                </Card>

                <Card
                    class="hover:shadow-xl transition-shadow duration-300 cursor-pointer group"
                >
                    <template #header>
                        <div
                            class="bg-gradient-to-r from-teal-400 to-teal-600 h-32 flex items-center justify-center"
                        >
                            <i class="pi pi-shield text-4xl text-white"></i>
                        </div>
                    </template>
                    <template #title>
                        <h3
                            class="text-xl font-semibold text-gray-900 group-hover:text-teal-600 transition-colors"
                        >
                            การรักษาทางการแพทย์
                        </h3>
                    </template>
                    <template #content>
                        <p class="text-gray-600">
                            ตรวจสุขภาพ, การรักษาเฉพาะทาง, และการฟื้นฟูสุขภาพ
                        </p>
                    </template>
                </Card>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-gradient-to-r from-emerald-600 to-teal-600">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-white mb-6">
                พร้อมเริ่มต้นการเดินทางเพื่อสุขภาพแล้วหรือยัง?
            </h2>
            <p class="text-xl text-emerald-100 mb-8 leading-relaxed">
                ให้ Wellth
                ช่วยคุณค้นหาประสบการณ์ท่องเที่ยวเพื่อสุขภาพที่เหมาะสมที่สุด
                เริ่มต้นด้วยการกรอกแบบสอบถามง่ายๆ เพียง 5 นาที
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <Link :href="route('user-preferences.create')">
                    <Button label="เริ่มต้นเลย" size="large" severity="secondary"  />
                </Link>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="col-span-2">
                    <h3 class="text-2xl font-bold text-emerald-400 mb-4">
                        Wellth
                    </h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        แพลตฟอร์มแนะนำการท่องเที่ยวเพื่อสุขภาพในประเทศไทย
                        ที่ใช้เทคโนโลยี AI
                        เพื่อให้คำแนะนำที่เหมาะสมกับแต่ละบุคคล
                    </p>
                    <div class="flex space-x-4">
                        <i
                            class="pi pi-facebook text-2xl text-gray-400 hover:text-emerald-400 cursor-pointer transition-colors"
                        ></i>
                        <i
                            class="pi pi-twitter text-2xl text-gray-400 hover:text-emerald-400 cursor-pointer transition-colors"
                        ></i>
                        <i
                            class="pi pi-instagram text-2xl text-gray-400 hover:text-emerald-400 cursor-pointer transition-colors"
                        ></i>
                        <i
                            class="pi pi-youtube text-2xl text-gray-400 hover:text-emerald-400 cursor-pointer transition-colors"
                        ></i>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">บริการ</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li>
                            <a
                                href="#"
                                class="hover:text-emerald-400 transition-colors"
                                >แนะนำสถานที่</a
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="hover:text-emerald-400 transition-colors"
                                >จองที่พัก</a
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="hover:text-emerald-400 transition-colors"
                                >โปรแกรมสุขภาพ</a
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="hover:text-emerald-400 transition-colors"
                                >ปรึกษาผู้เชี่ยวชาญ</a
                            >
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">ติดต่อเรา</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-center">
                            <i class="pi pi-phone mr-2"></i>
                            02-xxx-xxxx
                        </li>
                        <li class="flex items-center">
                            <i class="pi pi-envelope mr-2"></i>
                            info@wellth.co.th
                        </li>
                        <li class="flex items-center">
                            <i class="pi pi-map-marker mr-2"></i>
                            กรุงเทพมหานคร
                        </li>
                    </ul>
                </div>
            </div>

            <Divider class="my-8 border-gray-700" />

            <div
                class="flex flex-col md:flex-row justify-between items-center text-gray-400"
            >
                <p>&copy; 2024 Wellth. สงวนลิขสิทธิ์ทุกประการ</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-emerald-400 transition-colors"
                        >นโยบายความเป็นส่วนตัว</a
                    >
                    <a href="#" class="hover:text-emerald-400 transition-colors"
                        >เงื่อนไขการใช้งาน</a
                    >
                    <a href="#" class="hover:text-emerald-400 transition-colors"
                        >คำถามที่พบบ่อย</a
                    >
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>
/* Custom carousel styles */
:deep(.custom-carousel .p-carousel-content) {
    padding: 1rem 0;
}

:deep(.custom-carousel .p-carousel-indicators) {
    padding: 1rem 0;
}

:deep(.custom-carousel .p-carousel-indicator button) {
    background-color: #d1d5db;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: none;
    margin: 0 4px;
    transition: all 0.3s ease;
}

:deep(.custom-carousel .p-carousel-indicator.p-highlight button) {
    background-color: #059669;
    transform: scale(1.2);
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Animation classes */
.fade-in {
    animation: fadeIn 0.6s ease-in;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Hover effects */
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
        0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Custom button styles */
:deep(.p-button) {
    transition: all 0.3s ease;
}

:deep(.p-button:hover) {
    transform: translateY(-2px);
}

/* Card hover effects */
:deep(.p-card) {
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
}

:deep(.p-card:hover) {
    border-color: #059669;
    transform: translateY(-2px);
}

/* Responsive text sizes */
@media (max-width: 640px) {
    .text-5xl {
        font-size: 2.5rem;
    }

    .text-7xl {
        font-size: 3rem;
    }

    .text-4xl {
        font-size: 2rem;
    }
}

/* Loading animation for images */
img {
    transition: opacity 0.3s ease;
}

img:not([src]) {
    opacity: 0;
}

/* Gradient text effect */
.gradient-text {
    background: linear-gradient(135deg, #059669, #0d9488);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
    background: #059669;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #047857;
}

/* Floating animation */
@keyframes float {
    0%,
    100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

.float-animation {
    animation: float 3s ease-in-out infinite;
}

/* Pulse animation for CTA buttons */
@keyframes pulse {
    0%,
    100% {
        box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(5, 150, 105, 0);
    }
}

.pulse-animation {
    animation: pulse 2s infinite;
}

/* Parallax effect */
.parallax {
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

/* Custom focus styles */
:deep(.p-button:focus) {
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.3);
}

:deep(.p-checkbox:focus) {
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.3);
}

/* Loading skeleton */
.skeleton {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}

/* Print styles */
@media print {
    .no-print {
        display: none;
    }
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .text-gray-600 {
        color: #000;
    }

    .text-gray-300 {
        color: #fff;
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Dark mode support (if needed in future) */
@media (prefers-color-scheme: dark) {
    /* Dark mode styles can be added here */
}
</style>
