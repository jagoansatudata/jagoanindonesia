# ⚡ Vibe Coding Rules — Jagoan Website

> Panduan wajib saat development menggunakan **Cursor AI**.
> Baca sekali, tempel di meja, ikuti setiap sesi coding.

---

## 🧠 Mindset Vibe Coding

```
Kamu adalah arsitek, AI adalah tukang bangunan.
Kamu yang menentukan arah — AI yang mengeksekusi.
Tapi kamu tetap WAJIB paham apa yang dibangun.
```

**Tiga hukum vibe coding:**
1. Selalu beri konteks yang cukup sebelum prompt
2. Selalu review sebelum jalankan kode AI
3. Selalu commit sebelum lanjut ke fitur berikutnya

---

## 🛠 Setup Cursor

### Extensions Wajib
- **Laravel Extension Pack** — syntax, blade support
- **Tailwind CSS IntelliSense** — autocomplete class
- **PHP Intelephense** — PHP language server
- **GitLens** — visualisasi git history

### Cursor Rules (`.cursorrules`)

Buat file `.cursorrules` di root project, isi dengan ini:

```
You are an expert Laravel 11 developer.

Stack:
- Laravel 11
- Blade + Livewire 3
- Filament v3
- Tailwind CSS v3
- Alpine.js
- Spatie Media Library
- MySQL 8 / PHP 8.3

Coding rules you MUST follow:
- PSR-12 code style for all PHP files
- Use strict_types=1 on every PHP file
- Controller: only 7 RESTful methods (index, create, store, show, edit, update, destroy)
- Model: always define $fillable, $casts, and relationships explicitly
- Never use DB::statement or raw queries — use Eloquent
- Blade: no logic in views, use @php sparingly
- Always use named routes
- Migration: always add index on foreign keys and frequently queried columns
- Naming: follow conventions listed in the project README

When generating code, always include:
1. Type hints on all method parameters and return types
2. PHPDoc blocks on public methods
3. Validation rules in Form Request classes (not inline in controller)
```

---

## 📁 Struktur Folder

Jangan ubah struktur ini tanpa alasan kuat. Prompt AI selalu mengikuti struktur di bawah.

```
app/
├── Filament/
│   └── Resources/              # Satu file per resource Filament
│
├── Http/
│   ├── Controllers/            # Hanya RESTful controller
│   ├── Requests/               # Form Request untuk semua validasi
│   │   ├── StorePostRequest.php
│   │   └── UpdatePostRequest.php
│   └── Livewire/               # Satu file per komponen Livewire
│
├── Models/                     # Satu file per model
├── Services/                   # Business logic kompleks (opsional)
└── Helpers/                    # Helper function global (opsional)

resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php       # Layout utama
│   ├── components/             # Blade components reusable
│   │   ├── navbar.blade.php
│   │   ├── footer.blade.php
│   │   └── section-hero.blade.php
│   ├── pages/                  # Halaman publik
│   │   ├── home.blade.php
│   │   ├── blog/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   └── contact.blade.php
│   └── livewire/               # View untuk Livewire component
│
database/
├── migrations/                 # Format: tahun_bulan_hari_jam_nama.php
├── seeders/
│   ├── DatabaseSeeder.php      # Entry point seeder
│   └── PostSeeder.php          # Satu file per tabel
└── factories/
```

### Aturan Struktur

- ✅ Satu class = satu file
- ✅ Blade component untuk UI yang dipakai lebih dari 1 kali
- ✅ Form Request untuk semua validasi, bukan inline controller
- ❌ Jangan taruh logic di Blade view
- ❌ Jangan taruh query Eloquent di dalam Blade
- ❌ Jangan buat folder baru tanpa mendokumentasikannya di sini

---

## 📝 Naming Convention

### PHP / Laravel

| Komponen | Format | Contoh |
|---|---|---|
| Model | `PascalCase` singular | `TeamMember` |
| Controller | `PascalCase` + Controller | `TeamMemberController` |
| Livewire | `PascalCase` | `ContactForm` |
| Form Request | `Store/Update` + Model + `Request` | `StorePostRequest` |
| Migration | `snake_case` deskriptif | `create_team_members_table` |
| Seeder | `PascalCase` + Seeder | `TeamMemberSeeder` |
| Route name | `snake_case` dengan titik | `blog.index`, `blog.show` |
| Blade view | `kebab-case` | `section-hero.blade.php` |
| Blade component | `kebab-case` | `<x-section-hero />` |

### Database

| Komponen | Format | Contoh |
|---|---|---|
| Nama tabel | `snake_case` plural | `team_members` |
| Nama kolom | `snake_case` | `published_at` |
| Foreign key | `{model}_id` | `category_id` |
| Pivot table | Dua model, alphabetical | `post_tag` |
| Index | `{tabel}_{kolom}_index` | `posts_category_id_index` |
| Boolean kolom | `is_` atau `has_` prefix | `is_published`, `has_thumbnail` |

### JavaScript / Alpine.js

| Komponen | Format | Contoh |
|---|---|---|
| Variable | `camelCase` | `isMenuOpen` |
| Function | `camelCase` | `toggleMenu()` |
| CSS class custom | `kebab-case` | `.hero-section` |

---

## 🎨 Code Style (PSR-12)

Semua PHP wajib ikuti PSR-12. Cursor harus selalu generate kode yang sesuai.

### Wajib di Setiap File PHP

```php
<?php

declare(strict_types=1);

namespace App\Http\Controllers;
```

### Controller

```php
<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Tampilkan daftar semua post yang dipublikasikan.
     */
    public function index(): View
    {
        $posts = Post::published()
            ->with('category')
            ->latest('published_at')
            ->paginate(9);

        return view('pages.blog.index', compact('posts'));
    }

    /**
     * Simpan post baru ke database.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        Post::create($request->validated());

        return redirect()->route('blog.index')
            ->with('success', 'Post berhasil ditambahkan.');
    }
}
```

### Model

```php
<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    // ─── Relationships ──────────────────────────────────────

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ─── Scopes ─────────────────────────────────────────────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at');
    }
}
```

### Blade View

```blade
{{-- ✅ Benar: logika di controller, view hanya tampilkan --}}
@foreach ($posts as $post)
    <x-post-card :post="$post" />
@endforeach

{{-- ❌ Salah: query di dalam blade --}}
@foreach (App\Models\Post::all() as $post)
    {{ $post->title }}
@endforeach
```

### Aturan Tambahan

- Gunakan `match()` bukan `switch()` untuk PHP 8+
- Gunakan named arguments untuk fungsi dengan banyak parameter
- Gunakan `readonly` property di mana memungkinkan
- Method chaining: satu method per baris jika lebih dari 2 chain
- Spasi 4 karakter (bukan tab) — Cursor default sudah benar

---

## 🔀 Git Commit Message

Gunakan format **Conventional Commits**. Cursor bisa generate otomatis dari diff.

### Format

```
<type>(<scope>): <deskripsi singkat dalam bahasa Indonesia>

[body opsional — jelaskan kenapa, bukan apa]
```

### Tipe Commit

| Tipe | Kapan dipakai | Contoh |
|---|---|---|
| `feat` | Fitur baru | `feat(blog): tambah filter berdasarkan kategori` |
| `fix` | Perbaikan bug | `fix(contact): form tidak terkirim saat validasi gagal` |
| `style` | Perubahan UI/CSS | `style(hero): sesuaikan warna tombol CTA` |
| `refactor` | Refactor kode | `refactor(post): pindahkan logika ke PostService` |
| `chore` | Config, dependency | `chore: install spatie media library` |
| `docs` | Dokumentasi | `docs: update README instalasi` |
| `test` | Tambah/ubah test | `test(post): tambah test untuk scope published` |
| `db` | Migrasi/seeder | `db: tambah kolom order di tabel team_members` |

### Aturan Commit

- ✅ Deskripsi maksimal 72 karakter
- ✅ Gunakan kalimat imperatif: "tambah", "perbaiki", "hapus"
- ✅ Commit per fitur kecil, bukan numpuk banyak perubahan
- ✅ Commit sebelum eksperimen baru
- ❌ Jangan commit kode yang error / belum jalan
- ❌ Hindari: `fix bug`, `update`, `wip`, `asdf`

### Cara Generate dengan Cursor

1. Buka Source Control (`Ctrl+Shift+G`)
2. Klik ikon ✨ (Generate Commit Message)
3. Review hasilnya, sesuaikan dengan format di atas
4. Commit

---

## 💬 Prompt Rules di Cursor

### Sebelum Prompt, Selalu Sertakan

```
Ikuti rules berikut:
- PSR-12, declare(strict_types=1)
- Naming convention sesuai README
- Validasi di Form Request, bukan di Controller
- Gunakan type hint dan return type di semua method
- Blade hanya untuk tampilan, tidak ada logika/query
```

### Template Prompt Harian

**Buat fitur baru:**
```
Buatkan [nama fitur] untuk proyek Laravel 11 ini.
Ikuti struktur folder dan naming convention di README.
Yang dibutuhkan:
- Migration: [daftar kolom]
- Model: dengan fillable, casts, relasi [...]
- Controller: method [index/store/dll]
- Form Request: validasi [...]
- Blade view: tampilkan [...]
- Route: named route [nama.route]
```

**Perbaiki kode:**
```
Review kode ini dan sesuaikan dengan:
- PSR-12
- Naming convention project
- Pindahkan validasi ke Form Request jika masih inline
- Tambahkan type hint yang kurang
[paste kode]
```

**Debug error:**
```
Error berikut muncul di Laravel 11:
[paste error lengkap]

File: [nama file]
Konteks: [apa yang sedang dilakukan]
Tolong jelaskan penyebab dan solusinya sesuai best practice Laravel.
```

---

## ✅ Checklist Sebelum Commit

Jalankan checklist ini setiap kali mau commit:

```
[ ] Kode tidak ada syntax error (php artisan serve jalan)
[ ] Naming convention sudah benar (lihat tabel di atas)
[ ] Tidak ada logika/query di Blade view
[ ] Validasi ada di Form Request, bukan di Controller
[ ] Migration sudah dijalankan (php artisan migrate)
[ ] Tidak ada dd(), var_dump(), atau console.log() tertinggal
[ ] Tidak ada file .env atau credential di-commit
[ ] Commit message mengikuti format Conventional Commits
```

---

## 🚫 Hal yang Tidak Boleh di-Generate AI Tanpa Review

Selalu review manual sebelum jalankan kode AI untuk hal-hal ini:

- **Migration** — pastikan nama kolom, tipe data, dan index sudah benar
- **Kode yang menyentuh `.env`** — jangan sampai credential ter-expose
- **Mass assignment** — pastikan `$fillable` tidak terlalu lebar
- **Delete / truncate** — verifikasi kondisi where-nya
- **Raw query** — ganti dengan Eloquent jika memungkinkan

---

## 🔗 Referensi Cepat

- [PSR-12 Standard](https://www.php-fig.org/psr/psr-12/)
- [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/)
- [Laravel 11 Docs](https://laravel.com/docs/11.x)
- [Livewire 3 Docs](https://livewire.laravel.com)
- [Filament v3 Docs](https://filamentphp.com/docs)
- [Cursor Docs](https://docs.cursor.com)

---

<p align="center">🎯 Vibe dengan arah yang jelas. Code yang rapi bukan hambatan — itu kebiasaan.</p>
