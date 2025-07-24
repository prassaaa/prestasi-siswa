# 🏆 Sistem Manajemen Prestasi Siswa

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1+-blue?style=for-the-badge&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0+-orange?style=for-the-badge&logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-cyan?style=for-the-badge&logo=tailwindcss" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/Alpine.js-3.x-green?style=for-the-badge&logo=alpine.js" alt="Alpine.js">
</p>

<p align="center">
  <strong>Aplikasi web untuk mengelola dan memverifikasi prestasi siswa secara digital</strong>
</p>

---

## 📋 Deskripsi

Sistem Manajemen Prestasi Siswa adalah aplikasi web yang dirancang untuk membantu sekolah dan institusi pendidikan dalam mengelola, memverifikasi, dan melacak prestasi siswa secara digital. Aplikasi ini menyediakan platform yang memungkinkan siswa untuk mendaftarkan prestasi mereka, admin untuk memverifikasi prestasi, dan masyarakat umum untuk melihat prestasi yang telah diverifikasi.

## ✨ Fitur Utama

### 👨‍🎓 Untuk Siswa
- **Registrasi Prestasi**: Mendaftarkan prestasi dengan upload bukti dokumen
- **Dashboard Personal**: Melihat statistik prestasi pribadi
- **Manajemen Profil**: Mengelola data pribadi dan sekolah
- **Riwayat Prestasi**: Melihat semua prestasi yang pernah didaftarkan
- **Status Verifikasi**: Memantau status verifikasi prestasi
- **Cetak Sertifikat**: Mencetak prestasi yang telah diverifikasi dalam format PDF
- **Notifikasi**: Menerima pemberitahuan terkait status prestasi

### 👨‍💼 Untuk Admin
- **Dashboard Admin**: Overview statistik sistem secara keseluruhan
- **Manajemen Siswa**: CRUD data siswa dan sekolah
- **Manajemen Lomba**: CRUD data lomba dan kompetisi
- **Verifikasi Prestasi**: Menyetujui atau menolak prestasi dengan catatan
- **Manajemen Notifikasi**: Mengirim notifikasi ke siswa
- **Export Data**: Export data lomba ke PDF
- **Filter & Pencarian**: Filter prestasi berdasarkan status, tingkat, dan jenjang

### 🌐 Untuk Publik
- **Landing Page**: Informasi umum dan statistik prestasi
- **Galeri Prestasi**: Melihat prestasi yang telah diverifikasi
- **Informasi Lomba**: Daftar lomba yang tersedia
- **Pencarian**: Mencari prestasi dan lomba tertentu

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 10.x** - PHP Framework
- **PHP 8.1+** - Programming Language
- **MySQL** - Database
- **Laravel Breeze** - Authentication
- **Laravel Sanctum** - API Authentication
- **DomPDF** - PDF Generation

### Frontend
- **Blade Templates** - Templating Engine
- **TailwindCSS 3.x** - CSS Framework
- **Alpine.js 3.x** - JavaScript Framework
- **Vite** - Build Tool

### Development Tools
- **Composer** - PHP Dependency Manager
- **NPM** - Node Package Manager
- **Laravel Tinker** - REPL
- **PHPUnit** - Testing Framework

## 📊 Struktur Database

### Tabel Utama
- **users** - Data pengguna (admin/siswa)
- **roles** - Role pengguna
- **siswa** - Data detail siswa
- **sekolah** - Data sekolah
- **lomba** - Data lomba/kompetisi
- **prestasi** - Data prestasi siswa
- **notifikasi** - Sistem notifikasi

### Relasi Database
- User → Siswa (One to One)
- Siswa → Sekolah (Many to One)
- Siswa → Prestasi (One to Many)
- Lomba → Prestasi (One to Many)
- User → Notifikasi (One to Many)

## 🚀 Instalasi

### Prasyarat
- PHP 8.1 atau lebih tinggi
- Composer
- Node.js & NPM
- MySQL 8.0+
- Web Server (Apache/Nginx)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd prestasi-siswa
   ```

2. **Install Dependencies**
   ```bash
   # Install PHP dependencies
   composer install

   # Install Node dependencies
   npm install
   ```

3. **Environment Setup**
   ```bash
   # Copy environment file
   cp .env.example .env

   # Generate application key
   php artisan key:generate
   ```

4. **Database Configuration**

   Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=prestasi_siswa
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

5. **Database Migration & Seeding**
   ```bash
   # Create database
   php artisan migrate

   # Seed initial data (optional)
   php artisan db:seed
   ```

6. **Storage Link**
   ```bash
   php artisan storage:link
   ```

7. **Build Assets**
   ```bash
   # Development
   npm run dev

   # Production
   npm run build
   ```

8. **Start Development Server**
   ```bash
   php artisan serve
   ```

   Aplikasi akan berjalan di `http://localhost:8000`

## 🔧 Konfigurasi

### File Upload
Pastikan direktori `storage/app/public` memiliki permission yang tepat untuk upload file bukti prestasi.

### Email Configuration
Untuk fitur notifikasi email, konfigurasi SMTP di file `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

## 📱 Penggunaan

### Akses Admin
1. Buat akun admin melalui seeder atau registrasi manual
2. Login dengan role admin
3. Akses dashboard admin di `/admin/dashboard`

### Akses Siswa
1. Registrasi sebagai siswa di `/register-siswa`
2. Login dengan akun siswa
3. Akses dashboard siswa di `/siswa/dashboard`

### Workflow Prestasi
1. **Siswa** mendaftarkan prestasi dengan upload bukti
2. **Admin** memverifikasi prestasi (approve/reject)
3. **Siswa** menerima notifikasi hasil verifikasi
4. **Prestasi yang disetujui** tampil di halaman publik

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=PrestasiTest

# Run with coverage
php artisan test --coverage
```

## 📝 API Documentation

### Authentication
- `POST /login` - Login user
- `POST /logout` - Logout user
- `POST /register-siswa` - Register siswa

### Prestasi Endpoints
- `GET /api/prestasi/{id}` - Get prestasi detail
- `GET /api/lomba/{id}` - Get lomba detail

## 🤝 Contributing

1. Fork repository ini
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

### Coding Standards
- Ikuti PSR-12 coding standard
- Gunakan meaningful variable names
- Tambahkan komentar untuk logic yang kompleks
- Write tests untuk fitur baru

## 📄 License

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
---

<p align="center">
  <strong>Dibuat dengan ❤️ untuk kemajuan pendidikan Indonesia</strong>
</p>
