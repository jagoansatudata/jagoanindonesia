# Page Access Management - Documentation

## Overview

Fitur Page Access Management memungkinkan admin untuk mengontrol akses pengguna ke halaman-halaman tertentu menggunakan **toggle switches** yang sederhana dan intuitif. Sistem ini menggunakan middleware untuk memeriksa izin akses sebelum pengguna dapat mengakses halaman yang dilindungi.

## Cara Kerja

### 1. Role System
- **User**: Role dasar dengan akses terbatas
- **Admin**: Bisa mengelola users dan pages, memiliki akses ke halaman yang diassign
- **Super Admin**: Akses penuh ke semua halaman dan fitur

### 2. Model & Database
- **Pages**: Tabel yang menyimpan informasi halaman (nama, route, deskripsi)
- **User Page Permissions**: Tabel pivot yang menghubungkan user dengan halaman yang bisa diakses
- **Users**: Tabel dengan field `role` untuk mengatur hak akses

### 3. Middleware
- `PageAccessMiddleware`: Memeriksa izin akses berdasarkan route name
- `RoleMiddleware`: Memeriksa role user untuk akses ke resource tertentu
- Super Admin otomatis memiliki akses ke semua halaman

## Cara Penggunaan

### 1. Konfigurasi Halaman

**Buka Admin Panel** > **Page Access Management**

1. **Add New Page**:
   - Masukkan nama halaman (contoh: "Dashboard")
   - Masukkan route name (contoh: "admin.dashboard")
   - Tambahkan deskripsi singkat
   - Set status Active

2. **Manage Access dengan Toggle**:
   - Gunakan toggle switches untuk memberi/hapus akses user
   - Super Admin otomatis memiliki akses ke semua halaman (toggle disabled)
   - Gunakan bulk actions untuk multiple users sekaligus

### 3. Role Management

**Buka Admin Panel** > **Users**

1. **Create User dengan Role**:
   - Pilih role yang sesuai (User, Admin, Super Admin)
   - Hanya Super Admin yang bisa assign semua role
   - Admin hanya bisa assign User role

2. **Role Permissions**:
   - **User**: Hanya bisa akses halaman yang diassign
   - **Admin**: Bisa manage users & pages, akses halaman yang diassign
   - **Super Admin**: Akses penuh ke semua fitur dan halaman

### 4. Menggunakan Middleware pada Routes

Tambahkan middleware `page.access` dengan parameter route name:

```php
// Contoh di routes/web.php
Route::middleware(['auth', 'page.access:admin.dashboard'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'page.access:reports.index'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});
```

**Role-based Protection:**

```php
// Hanya Admin dan Super Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
});

// Hanya Super Admin
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings.index');
});
```

### 5. Mengecek Akses di Controller

```php
// Di dalam controller method
public function someMethod()
{
    $user = auth()->user();
    
    // Cek role
    if ($user->isAdmin()) {
        // User adalah Admin atau Super Admin
    }
    
    if ($user->isSuperAdmin()) {
        // User adalah Super Admin
    }
    
    // Cek akses halaman
    if ($user->hasPageAccess('admin.dashboard')) {
        // User memiliki akses ke halaman
    }
    
    // Cek permission
    if ($user->canManageUsers()) {
        // User bisa manage users
    }
    
    if ($user->canManagePages()) {
        // User bisa manage pages
    }
    
    // Atau menggunakan model Page
    $page = Page::where('route_name', 'admin.dashboard')->first();
    if ($page && $page->hasAccess($user)) {
        // User memiliki akses ke halaman ini
    }
}
```

## Fitur Utama

### 1. Toggle Switch Interface
- **Individual Toggle**: Switch akses per user dengan satu klik
- **Page Status Toggle**: Aktifkan/nonaktifkan halaman
- **Real-time Updates**: Perubahan langsung tersimpan dengan AJAX
- **Visual Feedback**: Toast notifications untuk setiap aksi

### 2. Bulk Actions
- **Select All/Clear All**: Pilih semua user atau bersihkan seleksi
- **Bulk Grant**: Berikan akses ke multiple user sekaligus
- **Bulk Revoke**: Hapus akses dari multiple user sekaligus
- **Role Protection**: Super Admin users tidak bisa diubah access-nya

### 3. Role-Based Interface
- **Role Badges**: Visual indicators dengan warna berbeda (Gray/Blue/Emerald)
- **Permission Filtering**: Checkbox dan toggle disabled untuk Super Admin
- **Role Assignment**: Dropdown role dengan validation berdasarkan user role
- **Access Control**: Otomatis filter interface berdasarkan user permissions

### 3. User Management Integration
- Terintegrasi dengan sistem user management yang sudah ada
- Admin users otomatis memiliki akses ke semua halaman
- Non-admin users hanya bisa mengakses halaman yang diizinkan
- Visual indicators untuk admin vs regular users

### 4. Simplified Forms
- **Create Form**: Hanya field penting (nama, route, deskripsi, status)
- **Edit Form**: Update informasi dasar halaman
- **No User Selection**: User access dikelola di main page dengan toggle

## Security Features

1. **Automatic Admin Access**: User dengan `is_admin = true` otomatis memiliki akses
2. **Route-based Control**: Akses dikontrol berdasarkan Laravel route name
3. **Granular Permissions**: Bisa mengatur akses per user per halaman
4. **403 Forbidden**: User tanpa akses akan mendapatkan error 403

## Best Practices

### 1. Route Naming
Gunakan route name yang konsisten:
```php
// Good
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');

// Bad (tidak bisa diakses oleh middleware)
Route::get('/admin/users', [UserController::class, 'index']);
```

### 2. Page Configuration
- Berikan nama yang deskriptif
- Gunakan route name yang tepat
- Aktifkan hanya halaman yang perlu dikontrol aksesnya

### 3. User Assignment
- Assign hanya user yang benar-benar perlu akses
- Review permission secara berkala
- Gunakan groups untuk user dengan role serupa

## Quick Start Guide

### 1. Setup Halaman
```bash
// Run migration
php artisan migrate

// Run seeder untuk contoh halaman
php artisan db:seed --class=PageSeeder
```

### 2. Menggunakan Toggle Interface
1. **Buka** `/admin/pages`
2. **Add Page**: Klik "Add Page" untuk halaman baru
3. **Toggle Access**: Gunakan switch untuk memberi/hapus akses
4. **Bulk Actions**: Pilih multiple users lalu "Grant Selected" atau "Revoke Selected"

### 3. Apply Middleware
```php
// Tambahkan ke route yang ingin diproteksi
Route::middleware(['auth', 'page.access:admin.dashboard'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});
```

## Troubleshooting

### 1. User tidak bisa akses halaman
- Pastikan user sudah login
- Cek toggle switch untuk user tersebut
- Verifikasi route name sudah benar

### 2. Toggle tidak berfungsi
- Refresh halaman
- Cek console untuk JavaScript errors
- Pastikan bukan admin user (admin auto-access)

### 3. Halaman tidak muncul di daftar
- Pastikan halaman sudah dibuat
- Cek status halaman (harus Active)
- Verify route name sudah terdaftar

### 4. Bulk actions tidak bekerja
- Pastikan user sudah dipilih (checkbox)
- User admin tidak bisa dipilih (auto-access)
- Cek internet connection untuk AJAX requests

## Migration & Seeding

Run migration untuk membuat tabel:
```bash
php artisan migrate
```

Run seeder untuk membuat contoh halaman:
```bash
php artisan db:seed --class=PageSeeder
```

Run seeder untuk membuat sample users dengan role:
```bash
php artisan db:seed --class=RoleSeeder
```

**Sample Users yang Dibuat:**
- **user@example.com** (password: password) - Role: User
- **admin@example.com** (password: password) - Role: Admin  
- **superadmin@example.com** (password: password) - Role: Super Admin

## Example Implementation

Contoh implementasi untuk melindungi halaman reports:

```php
// routes/web.php
Route::middleware(['auth', 'page.access:reports.index'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');
});

// Di Page Access Management, buat page dengan:
// - Name: "Reports"
// - Route Name: "reports.index"
// - Assign user yang boleh akses reports
```

Sekarang hanya user yang diassign yang bisa mengakses halaman reports, admin users otomatis memiliki akses.
