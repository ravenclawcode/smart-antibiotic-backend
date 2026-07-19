php artisan medicine:check-missed

POST http://127.0.0.1:8000/api/onboarding
Kirim
{
    "uuid": "550e8400-e29b-41d4-a716-446655440001",
    "name": "Syifa",
    "reminder_type": "Ringkas",
    "reminder_sound": "Serenity"
}

Hasil
{
    "success": true,
    "message": "Onboarding berhasil.",
    "data": {
        "uuid": "550e8400-e29b-41d4-a716-446655440001",
        "name": "Syifa",
        "updated_at": "2026-07-18T08:42:26.000000Z",
        "created_at": "2026-07-18T08:42:26.000000Z",
        "id": 10,
        "preference": {
            "id": 8,
            "user_id": 10,
            "reminder_type": "Ringkas",
            "reminder_sound": "Serenity",
            "timezone": "Asia/Jakarta",
            "pre_reminder_minutes": 30,
            "created_at": "2026-07-18T08:42:26.000000Z",
            "updated_at": "2026-07-18T08:42:26.000000Z"
        }
    }
}

GET http://127.0.0.1:8000/api/splash/{uuid}
Hasil
{
    "success": true,
    "is_registered": true
}

GET http://127.0.0.1:8000/api/profile/{uuid}
Hasil
{
    "success": true,
    "data": {
        "uuid": "550e8400-e29b-41d4-a716-446655440005",
        "name": "Aloy",
        "age": 27,
        "gender": "Laki-laki"
    }
}

PUT http://127.0.0.1:8000/api/profile/{uuid}
Kirim
{
    "name": "Syifa",
    "age": 23,
    "gender": "Perempuan"
}

Hasil
{
    "success": true,
    "message": "Profil berhasil diperbarui.",
    "data": {
        "uuid": "550e8400-e29b-41d4-a716-446655440001",
        "name": "Syifa",
        "age": 23,
        "gender": "Perempuan"
    }
}

GET http://127.0.0.1:8000/api/preferences/{uuid}
Hasil
{
    "success": true,
    "data": {
        "reminder_type": "Ringkas",
        "reminder_sound": "Serenity",
        "timezone": "Asia/Jakarta"
    }
}

PUT http://127.0.0.1:8000/api/preferences/{uuid}
Kirim
{
    "reminder_type": "Layar Penuh",
    "reminder_sound": "Peaceful"
}

Hasil
{
    "success": true,
    "message": "Preferensi berhasil diperbarui.",
    "data": {
        "reminder_type": "Layar Penuh",
        "reminder_sound": "Peaceful",
        "timezone": "Asia/Jakarta"
    }
}

GET http://127.0.0.1:8000/api/medicine-catalogs
Hasil
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Amoxicillin",
            "image": "medicine_catalog/k1fTp0E1TB5gqttYZJ76ISUFIOP3QYpKoyy2daks.png"
        },
        {
            "id": 5,
            "name": "Ampicillin",
            "image": "medicine_catalog/kxBRAYNi1wcBr7M58KuwOZqQdInMZcY06Ufa8ZzK.png"
        },
        {
            "id": 7,
            "name": "Oxacillin",
            "image": "medicine_catalog/vtpQO2zN3YtJhkvKeuct21LpeFieDmUZkWHzdTXO.png"
        },
        {
            "id": 6,
            "name": "Piperacillin",
            "image": "medicine_catalog/za80vGHcLYjLvihX4taLAu5LLBRAD3400bWyAln0.png"
        }
    ]
}

GET http://127.0.0.1:8000/api/categories
Hasil
{
    "success": true,
    "data": [
        {
            "id": 10,
            "name": "Cephalosporin",
            "image": "categories/5PeSW8J1pPHLVNFIBlTaTbJgkF6HFbQOpmtOKd63.png",
            "description": "Membunuh bakteri dengan merusak dinding sel."
        },
        {
            "id": 1,
            "name": "Penicillin",
            "image": "categories/gbsQn8mWAFVbZmfqtfLigfHO77mYpqOlgCEiUcse.png",
            "description": "Kelompok antibiotik beta-laktam."
        }
    ]
}

GET http://127.0.0.1:8000/api/categories/{category}/antibiotics
Hasil
{
    "success": true,
    "data": [
        {
            "id": 5,
            "name": "Ampicillin",
            "image": "antibiotics/U9y1MiPT7WJ3znbWlBGF8vG8SqCjFDGvt55hk8T3.png"
        },
        {
            "id": 1,
            "name": "Amoxicillin",
            "image": "antibiotics/gZCONQkHaDPXR1vH2FXFHWCquBl4A7zjltWZ54pt.png"
        }
    ]
}

GET http://127.0.0.1:8000/api/categories/{category}/antibiotics/{antibiotic}
Hasil
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Amoxicillin",
        "image": "antibiotics/gZCONQkHaDPXR1vH2FXFHWCquBl4A7zjltWZ54pt.png",
        "summary": "Amoxicillin adalah antibiotik golongan penisilin yang digunakan untuk mengobati infeksi yang disebabkan oleh bakteri. Obat ini bekerja dengan menghentikan pertumbuhan bakteri sehingga infeksi dapat sembuh.",
        "indication": "Amoxicillin digunakan untuk mengatasi berbagai infeksi bakteri, seperti:\r\n- Infeksi tenggorokan \r\n- Infeksi telinga\r\n- Infeksi sinus\r\n- Infeksi saluran pernapasan\r\n- Infeksi saluran kemih\r\n- Infeksi kulit dan jaringan lunak\r\n- Infeksi gigi\r\n- Terapi infeksi Helicobacter pylori.",
        "mechanism": "Amoxicillin bekerja dengan menghambat pembentukan dinding sel bakteri.\r\n\r\nAkibatnya:\r\n- Dinding sel bakteri menjadi lemah\r\n- Bakteri pecah dan mati\r\n- Infeksi dapat dikendalikan oleh sistem kekebalan tubuh",
        "dosage": "Dosis harus mengikuti resep dokter.\r\n\r\nDewasa\r\n- 250–500 mg setiap 8 jam, atau\r\n- 500–875 mg setiap 12 jam.\r\n\r\nAnak-anak\r\n- Dosis dihitung berdasarkan berat badan, umumnya 20–45 mg/kgBB per hari, dibagi menjadi 2–3 kali pemberian.",
        "video_url": "https://youtu.be/dKr2SG-VbNQ?si=7QyzS10NHCZ-nkHT"
    }
}

GET http://127.0.0.1:8000/api/medicines
Kirim
{
    "uuid": "550e8400-e29b-41d4-a716-446655440005",
}
Hasil
{
    "success": true,
    "data": [
        {
            "id": 27,
            "medicine_name": "Oxacillin",
            "dosage": "2 Tablet",
            "instruction": "Sesudah makan",
            "start_date": "2026-07-17",
            "end_date": "2026-07-30",
            "status": "active",
            "times": [
                "08:00",
                "20:00"
            ]
        },
        {
            "id": 24,
            "medicine_name": "Amoxicillin",
            "dosage": "1 Tablet",
            "instruction": "Sesudah makan",
            "start_date": "2026-07-17",
            "end_date": "2026-07-22",
            "status": "active",
            "times": [
                "08:00"
            ]
        }
    ]
}

POST http://127.0.0.1:8000/api/medicines
Kirim

1 kali sehari
{
    "uuid": "550e8400-e29b-41d4-a716-446655440001",
    "medicine_catalog_id": 1,
    "dosage": "1 Tablet",
    "instruction": "Sesudah makan",
    "start_date": "2026-07-17",
    "end_date": "2026-07-22",

    "frequency_type": "daily",
    "times_per_day": 1,

    "times": [
        "08:00"
    ]
}

2 kali sehari
{
    "uuid": "550e8400-e29b-41d4-a716-446655440001",
    "medicine_catalog_id": 1,
    "dosage": "1 Tablet",
    "instruction": "Sesudah makan",
    "start_date": "2026-07-17",
    "end_date": "2026-07-22",

    "frequency_type": "daily",
    "times_per_day": 2,

    "times": [
        "08:00",
        "20:00"
    ]
}

3 kali sehari
{
    "uuid": "550e8400-e29b-41d4-a716-446655440001",
    "medicine_catalog_id": 1,
    "dosage": "1 Tablet",
    "instruction": "Sesudah makan",
    "start_date": "2026-07-17",
    "end_date": "2026-07-22",

    "frequency_type": "daily",
    "times_per_day": 3,

    "times": [
        "06:00",
        "14:00"
        "22:00"
    ]
}

Lebih dari 3 kali sehari
{
    "uuid": "550e8400-e29b-41d4-a716-446655440001",
    "medicine_catalog_id": 1,
    "dosage": "1 Tablet",
    "instruction": "Sesudah makan",
    "start_date": "2026-07-17",
    "end_date": "2026-07-22",

    "frequency_type": "daily",
    "times_per_day": 5,

    "times": [
        "06:00",
        "10:00",
        "14:00",
        "18:00",
        "22:00"
    ]
}

Hari Tertentu
{
    "uuid": "550e8400-e29b-41d4-a716-446655440001",
    "medicine_catalog_id": 1,
    "dosage": "1 Tablet",
    "instruction": "Sesudah makan",
    "start_date": "2026-07-17",
    "end_date": "2026-07-30",

    "frequency_type": "certain_days",

    "times_per_day": 2,

    "days": [
        "senin",
        "rabu",
        "jumat"
    ],

    "times": [
        "08:00",
        "20:00"
    ]
}

Setiap X Hari
{
    "uuid": "550e8400-e29b-41d4-a716-446655440001",
    "medicine_catalog_id": 1,
    "dosage": "1 Tablet",
    "instruction": "Sesudah makan",
    "start_date": "2026-07-17",
    "end_date": "2026-07-30",

    "frequency_type": "interval_days",

    "interval_value": 2,

    "times_per_day": 2,

    "times": [
        "08:00",
        "20:00"
    ]
}

Setiap X Minggu
{
    "uuid": "550e8400-e29b-41d4-a716-446655440001",
    "medicine_catalog_id": 1,
    "dosage": "1 Tablet",
    "instruction": "Sesudah makan",
    "start_date": "2026-07-17",
    "end_date": "2026-09-16",

    "frequency_type": "interval_weeks",

    "interval_value": 2,

    "times_per_day": 1,

    "days":[
        "senin",
        "kamis"
    ],

    "times": [
        "09:00"
    ]
}

Setiap X Bulan
{
    "uuid": "550e8400-e29b-41d4-a716-446655440001",
    "medicine_catalog_id": 1,
    "dosage": "1 Tablet",
    "instruction": "Sesudah makan",
    "start_date": "2026-07-17",
    "end_date": "2027-01-16",

    "frequency_type": "interval_months",

    "interval_value": 1,

    "times_per_day": 1,

    "dates":[
        9,
        13,
        16,
        20
    ],

    "times": [
        "09:00"
    ]
}

GET http://127.0.0.1:8000/api/medicines/{medicine}
Kirim
{
    "uuid": "550e8400-e29b-41d4-a716-446655440001",
}
Hasil
{
    "success": true,
    "data": {
        "id": 24,
        "medicine_name": "Amoxicillin",
        "category": "Penicillin",
        "dosage": "1 Tablet",
        "instruction": "Sesudah makan",
        "start_date": "2026-07-17",
        "end_date": "2026-07-22",
        "status": "active",
        "schedule": {
            "frequency_type": "daily",
            "times_per_day": 1,
            "interval_value": null,
            "selections": [],
            "times": [
                "08:00"
            ]
        }
    }
}


PUT http://127.0.0.1:8000/api/medicines/{medicine}
Kirim
{
    "uuid": "550e8400-e29b-41d4-a716-446655440001",
    "medicine_catalog_id": 1,
    "dosage": "2 Tablet",
    "instruction": "Sesudah makan",
    "start_date": "2026-07-17",
    "end_date": "2026-07-30",

    "frequency_type": "certain_days",

    "times_per_day": 2,

    "days": [
        "senin",
        "rabu",
        "jumat"
    ],

    "times": [
        "08:00",
        "20:00"
    ]
}

Hasil
{
    "success": true,
    "message": "Obat berhasil diperbarui.",
    "data": {
        "id": 28,
        "medicine_name": "Oxacillin",
        "dosage": "2 Tablet",
        "instruction": "Sesudah makan",
        "start_date": "2026-07-17",
        "end_date": "2026-07-30",
        "status": "active",
        "schedule": {
            "frequency_type": "certain_days",
            "times_per_day": 2,
            "interval_value": null,
            "selections": [
                "senin",
                "rabu",
                "jumat"
            ],
            "times": [
                "08:00",
                "20:00"
            ]
        }
    }
}

DELETE http://127.0.0.1:8000/api/medicines/{medicine}
Kirim
{
    "uuid": "550e8400-e29b-41d4-a716-446655440001",
}

Hasil
{
    "success": true,
    "message": "Obat berhasil dihapus."
}

POST http://127.0.0.1:8000/api/medicine-histories/taken
Kirim
{
    "schedule_time_id":57,
    "scheduled_date":"2026-07-18"
}

Hasil
{
    "success": true,
    "message": "Obat berhasil ditandai diminum.",
    "data": {
        "schedule_time_id": 57,
        "scheduled_date": "2026-07-18T00:00:00.000000Z",
        "status": "taken",
        "taken_at": "2026-07-18T16:08:31.000000Z",
        "notes": null,
        "rescheduled_time": null,
        "updated_at": "2026-07-18T09:08:31.000000Z",
        "created_at": "2026-07-18T09:08:31.000000Z",
        "id": 2
    }
}

POST http://127.0.0.1:8000/api/medicine-histories/skipped
Kirim
{
    "schedule_time_id":57,
    "scheduled_date":"2026-07-18",
    "notes":"Lupa membawa obat"
}

Hasil
{
    "success": true,
    "message": "Obat berhasil dilewati.",
    "data": {
        "id": 2,
        "schedule_time_id": 57,
        "scheduled_date": "2026-07-18T00:00:00.000000Z",
        "status": "skipped",
        "taken_at": null,
        "notes": "Lupa membawa obat",
        "rescheduled_time": null,
        "created_at": "2026-07-18T09:08:31.000000Z",
        "updated_at": "2026-07-18T09:12:24.000000Z"
    }
}

POST http://127.0.0.1:8000/api/medicine-histories/reschedule
Kirim
{
    "schedule_time_id":57,
    "scheduled_date":"2026-07-18",
    "rescheduled_time":"2026-07-18 13:00:00"
}

Hasil
{
    "success": true,
    "message": "Jadwal berhasil diubah.",
    "data": {
        "id": 2,
        "schedule_time_id": 57,
        "scheduled_date": "2026-07-18T00:00:00.000000Z",
        "status": "rescheduled",
        "taken_at": null,
        "notes": null,
        "rescheduled_time": "2026-07-18T13:00:00.000000Z",
        "created_at": "2026-07-18T09:08:31.000000Z",
        "updated_at": "2026-07-18T09:43:43.000000Z"
    }
}

POST http://127.0.0.1:8000/api/medicine-histories/missed
Kirim
{
    "schedule_time_id":57,
    "scheduled_date":"2026-07-18",
}

Hasil
{
    "success": true,
    "message": "Status berhasil diperbarui.",
    "data": {
        "id": 2,
        "schedule_time_id": 57,
        "scheduled_date": "2026-07-18T00:00:00.000000Z",
        "status": "missed",
        "taken_at": null,
        "notes": null,
        "rescheduled_time": null,
        "created_at": "2026-07-18T09:08:31.000000Z",
        "updated_at": "2026-07-18T09:19:28.000000Z"
    }
}

GET http://127.0.0.1:8000/api/medicine-histories/filter-medicines?user_id=9
Hasil
{
    "success": true,
    "data": [
        {
            "medicine_id": 30,
            "name": "Amoxicillin"
        },
        {
            "medicine_id": 31,
            "name": "Cefixime"
        },
        {
            "medicine_id": 35,
            "name": "Azithromycin"
        }
    ]
}

GET http://127.0.0.1:8000/api/medicine-histories?user_id=0
Hasil
{}

GET http://127.0.0.1:8000/api/medicine-histories?user_id=0&format=daily
Hasil
{}

GET http://127.0.0.1:8000/api/medicine-histories?user_id=0&format=weekly
Hasil
{}

GET http://127.0.0.1:8000/api/medicine-histories?user_id=0&format=monthly
Hasil
{}

GET http://127.0.0.1:8000/api/medicine-histories?user_id=9&format=weekly&medicine_id=30
Hasil
{}

GET http://127.0.0.1:8000/api/medicine-histories/export-pdf
Kirim
{
    "user_id":0,
    "medicine_id":0,
    "format":"weekly"
}

Hasil
{
    PDF File
}

GET http://127.0.0.1:8000/api/quizzes
Hasil
{
    "success": true,
    "data": [
        {
            "id": 6,
            "level": 1,
            "description": "Pengenalan Antibiotik"
        }
    ]
}

GET http://127.0.0.1:8000/api/quizzes/6
Hasil
{
    "success": true,
    "data": {
        "id": 6,
        "level": 1,
        "description": "Pengenalan Antibiotik",
        "questions": [
            {
                "id": 5,
                "question": "Apa fungsi utama dari antibiotik?",
                "option_a": "Menghilangkan virus penyebab penyakit",
                "option_b": "Membunuh atau menghambat pertumbuhan bakteri",
                "option_c": "Meredakan nyeri dan radang",
                "option_d": "Meningkatkan sistem kekebalan tubuh"
            },
            {
                "id": 8,
                "question": "Antibiotik tidak efektif untuk mengobati penyakit yang disebabkan oleh?",
                "option_a": "Bakteri",
                "option_b": "Jamur",
                "option_c": "Virus",
                "option_d": "Parasit"
            },
            {
                "id": 9,
                "question": "Mengapa antibiotik harus dihabiskan sesuai anjuran dokter?",
                "option_a": "Agar obat terasa lebih enak diminum",
                "option_b": "Untuk mencegah bakteri menjadi kebal terhadap antibiotik",
                "option_c": "Agar warna obat tidak berubah",
                "option_d": "Supaya tidak perlu membeli obat lagi"
            },
            {
                "id": 10,
                "question": "Kapan seseorang sebaiknya menggunakan antibiotik?",
                "option_a": "Saat mengalami flu biasa",
                "option_b": "Saat batuk karena alergi",
                "option_c": "Ketika diresepkan oleh tenaga kesehatan untuk infeksi bakteri",
                "option_d": "Setiap kali mengalami demam"
            },
            {
                "id": 11,
                "question": "Apa yang dimaksud dengan resistensi antibiotik?",
                "option_a": "Antibiotik menjadi lebih kuat",
                "option_b": "Tubuh kebal terhadap semua obat",
                "option_c": "Bakteri menjadi kebal terhadap antibiotik sehingga obat tidak lagi efektif",
                "option_d": "Antibiotik berubah menjadi racun"
            },
            {
                "id": 12,
                "question": "Apa yang sebaiknya dilakukan jika lupa meminum antibiotik sesuai jadwal?",
                "option_a": "Minum dua kali lipat pada jadwal berikutnya",
                "option_b": "Menghentikan pengobatan",
                "option_c": "Minum segera saat ingat jika belum dekat dengan jadwal berikutnya, lalu lanjutkan sesuai jadwal",
                "option_d": "Menunggu sampai keesokan harinya"
            },
            {
                "id": 13,
                "question": "Bolehkah antibiotik yang tersisa diberikan kepada orang lain?",
                "option_a": "Boleh, jika gejalanya sama",
                "option_b": "Boleh, jika masih belum kedaluwarsa",
                "option_c": "Tidak boleh, karena setiap orang memerlukan penanganan yang berbeda",
                "option_d": "Boleh, jika dosisnya dikurangi"
            },
            {
                "id": 14,
                "question": "Berikut ini yang merupakan contoh penggunaan antibiotik yang tidak tepat adalah?",
                "option_a": "Menghabiskan antibiotik sesuai resep",
                "option_b": "Menggunakan antibiotik atas anjuran dokter",
                "option_c": "Membeli antibiotik tanpa resep untuk mengobati pilek",
                "option_d": "Meminum antibiotik pada waktu yang telah ditentukan"
            },
            {
                "id": 15,
                "question": "Apa akibat penggunaan antibiotik yang tidak tepat?",
                "option_a": "Penyembuhan menjadi lebih cepat",
                "option_b": "Risiko terjadinya resistensi antibiotik meningkat",
                "option_c": "Antibiotik menjadi lebih murah",
                "option_d": "Semua bakteri langsung mati"
            },
            {
                "id": 16,
                "question": "Manakah pernyataan yang benar mengenai antibiotik?",
                "option_a": "Antibiotik dapat menyembuhkan semua jenis infeksi",
                "option_b": "Antibiotik hanya digunakan untuk mengobati infeksi bakteri tertentu sesuai petunjuk tenaga kesehatan",
                "option_c": "Antibiotik dapat digunakan kapan saja tanpa aturan",
                "option_d": "Antibiotik selalu aman digunakan tanpa efek samping"
            }
        ]
    }
}

POST http://127.0.0.1:8000/api/quizzes/0/submit
Kirim
{
    "user_id": 9,
    "answers": [
        {
            "question_id": 5,
            "answer": "B"
        },
        {
            "question_id": 8,
            "answer": "C"
        },
        {
            "question_id": 9,
            "answer": "B"
        },
        {
            "question_id": 10,
            "answer": "C"
        },
        {
            "question_id": 11,
            "answer": "C"
        },
        {
            "question_id": 12,
            "answer": "C"
        },
        {
            "question_id": 13,
            "answer": "A"
        },
        {
            "question_id": 14,
            "answer": "C"
        },
        {
            "question_id": 15,
            "answer": "B"
        },
        {
            "question_id": 16,
            "answer": "B"
        }
    ]
}

Hasil
{
    "success": true,
    "message": "Kuis berhasil diselesaikan.",
    "data": {
        "score": 90,
        "correct_answers": 9,
        "wrong_answers": 1
    }
}