# 📊 BijakGrow - Sistem Perbandingan Pelaburan ASB, Tabung Haji & Emas

Projek Laravel ini dibina khas untuk membantu pengguna membuat simulasi dan perbandingan keuntungan pelaburan antara ASB, Tabung Haji dan Emas dalam tempoh 1 hingga 5 tahun.

---

## 🚀 Features

- Input jumlah pelaburan + kadar pulangan setiap instrumen
- Kira keuntungan untuk 1, 2, 3, 4 dan 5 tahun
- Paparan dalam bentuk:
  - 📋 Jadual pulangan penuh
  - 📈 Carta bar interaktif
- Auto highlight instrumen pulangan tertinggi
- Responsive & clean UI

---

## 🛠 Teknologi Digunakan

- Laravel 12.x (backend)
- Blade + Tailwind CSS (frontend)
- Chart.js (graf perbandingan)
- Vite (asset bundling)

---

## ⚙️ Cara Setup (Local)

```bash
git clone https://github.com/badrulhazam/bijakgrow.git
cd bijakgrow

# Setup projek
composer install
cp .env.example .env
php artisan key:generate

# Setup frontend (optional)
npm install
npm run dev

# Setup database
php artisan migrate
