# 🏗️ ARSITEKTUR SISTEM - Sistem Voting Ketua Senat Fakultas

Dokumentasi lengkap mengenai arsitektur dan design pattern dari aplikasi.

---

## 🎯 OVERVIEW

Sistem Voting Ketua Senat Fakultas dibangun menggunakan **Laravel MVC Architecture** dengan design patterns:
- **MVC Pattern** (Model-View-Controller)
- **Repository Pattern** (implicit through controllers)
- **Middleware Pattern** (for authorization)
- **Service Layer** (business logic in controllers)

---

## 📐 ARSITEKTUR UMUM

```
┌─────────────────────────────────────────────────────────┐
│                     Web Browser                         │
└──────────────────────────┬──────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────┐
│              Laravel Routing Layer                      │
│                  (routes/web.php)                       │
│  - Auth routes      - Admin routes    - Mahasiswa routes│
└──────────────────────────┬──────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────┐
│              Middleware Pipeline                        │
│  - Authentication   - Authorization   - CSRF Protection│
│  - IsAdmin/IsMahasiswa (custom)                        │
└──────────────────────────┬──────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────┐
│                 Controllers                             │
│  Auth  Dashboard  Mahasiswa  Kandidat  Voting  Laporan │
│         (Business Logic & Request Handling)             │
└──────────────────────────┬──────────────────────────────┘
                           │
                ┌──────────┼──────────┐
                │          │          │
                ▼          ▼          ▼
            ┌──────────┐ ┌──────────┐ ┌──────────┐
            │  Models  │ │  Views   │ │ Storage  │
            └────┬─────┘ └────┬─────┘ └────┬─────┘
                 │            │            │
                 ▼            ▼            ▼
            ┌──────────┐ ┌──────────┐ ┌──────────┐
            │ Database │ │   Blade  │ │  Files   │
            │  (MySQL) │ │Templates │ │ (Images) │
            └──────────┘ └──────────┘ └──────────┘
```

---

## 🗂️ STRUKTUR DIREKTORI

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php          ← Auth logic
│   │   ├── DashboardController.php     ← Dashboard logic
│   │   ├── MahasiswaController.php     ← Mahasiswa CRUD
│   │   ├── KandidatController.php      ← Kandidat CRUD
│   │   ├── VotingController.php        ← Voting logic
│   │   └── LaporanController.php       ← Reports logic
│   ├── Middleware/
│   │   ├── IsAdmin.php                 ← Admin authorization
│   │   └── IsMahasiswa.php             ← Mahasiswa authorization
│   └── Requests/                       ← Future: FormRequests
│
├── Models/
│   ├── User.php                        ← User model
│   ├── Mahasiswa.php                   ← Mahasiswa model
│   ├── Kandidat.php                    ← Kandidat model
│   └── Voting.php                      ← Voting model
│
└── Providers/
    └── AppServiceProvider.php          ← Service bindings

database/
├── migrations/
│   ├── 0001_01_01_000000_create_users_table.php
│   ├── 2024_04_22_000001_create_mahasiswa_table.php
│   ├── 2024_04_22_000002_create_kandidat_table.php
│   └── 2024_04_22_000003_create_voting_table.php
│
└── seeders/
    └── DatabaseSeeder.php              ← Demo data

resources/
└── views/
    ├── layouts/
    │   └── app.blade.php               ← Master layout
    ├── auth/
    │   ├── login.blade.php
    │   └── register.blade.php
    ├── dashboard/
    │   ├── admin.blade.php
    │   └── mahasiswa.blade.php
    ├── mahasiswa/
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   └── edit.blade.php
    ├── kandidat/
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   └── edit.blade.php
    ├── voting/
    │   ├── index.blade.php
    │   └── hasil.blade.php
    └── laporan/
        ├── index.blade.php
        └── reset.blade.php

routes/
└── web.php                             ← Routing definitions
```

---

## 🔄 REQUEST LIFECYCLE

```
1. User Request
   ▼
2. Routing (web.php) - Match URL to route
   ▼
3. Middleware - CSRF, Auth, Custom (IsAdmin/IsMahasiswa)
   ▼
4. Controller - Process request, call models
   ▼
5. Model - Fetch/update database
   ▼
6. View - Render Blade template
   ▼
7. Response - Return HTML to browser
```

---

## 🔐 AUTHENTICATION FLOW

```
┌──────────────────────────────────────┐
│     User submits login form          │
└────────────┬─────────────────────────┘
             │
             ▼
┌──────────────────────────────────────┐
│  AuthController@login()              │
│  - Validate form                     │
│  - Check credentials                 │
└────────┬───────────────────────────┬─┘
         │ Success                   │ Failed
         ▼                           ▼
    ┌────────────┐          ┌──────────────┐
    │ Authenticate           │ Return error │
    │ Create session         └──────────────┘
    └──────┬─────┘
           │
           ▼
    ┌──────────────────────┐
    │ Check user role      │
    │ - Admin?             │
    │ - Mahasiswa?         │
    └──────┬────────┬──────┘
           │        │
        Admin    Mahasiswa
           │        │
           ▼        ▼
      dashboard.admin  dashboard.mahasiswa
```

---

## 📊 DATA FLOW - VOTING PROCESS

```
1. VOTING PAGE
   Mahasiswa access /voting
        ↓
   Check: Already voted?
        ├─ Yes → Redirect to /voting/hasil
        └─ No → Show candidates list

2. SELECT CANDIDATE
   Mahasiswa pilih kandidat
        ↓
   Submit form with kandidat_id
        ↓
   VotingController@store()

3. VALIDATE & SAVE
   Check: Already voted?
        ├─ Yes → Error message
        └─ No → Create Voting record
              └─ mahasiswa_id + kandidat_id
              └─ Database constraint: unique mahasiswa_id

4. SUCCESS
   Voting saved
        ↓
   Redirect to /voting/hasil
        ↓
   Display results with charts
```

---

## 🔗 DATABASE RELATIONSHIPS

### Users → Mahasiswa (One-to-One)
```php
// User Model
public function mahasiswa() {
    return $this->hasOne(Mahasiswa::class);
}

// Mahasiswa Model
public function user() {
    return $this->belongsTo(User::class);
}
```

### Mahasiswa → Voting (One-to-Many)
```php
// Mahasiswa Model
public function voting() {
    return $this->hasOne(Voting::class); // unique!
}

// Voting Model
public function mahasiswa() {
    return $this->belongsTo(Mahasiswa::class);
}
```

### Kandidat → Voting (One-to-Many)
```php
// Kandidat Model
public function voting() {
    return $this->hasMany(Voting::class);
}

// Voting Model
public function kandidat() {
    return $this->belongsTo(Kandidat::class);
}
```

---

## 🎛️ CONTROLLER RESPONSIBILITIES

### AuthController
```php
- showLogin()      → Display login form
- login()          → Handle login (validate & auth)
- logout()         → Handle logout (session destroy)
- showRegister()   → Display register form
- register()       → Handle registration (create user)
```

### DashboardController
```php
- adminDashboard()      → Stats for admin
- mahasiswaDashboard()  → Status for mahasiswa
```

### MahasiswaController (Resource)
```php
- index()          → List mahasiswa (paginated, searchable)
- create()         → Show create form
- store()          → Save new mahasiswa
- edit()           → Show edit form
- update()         → Update mahasiswa
- destroy()        → Delete mahasiswa
```

### KandidatController (Resource)
```php
- index()          → List kandidat (paginated, searchable)
- create()         → Show create form
- store()          → Save with foto upload
- edit()           → Show edit form
- update()         → Update with foto handling
- destroy()        → Delete with file cleanup
```

### VotingController
```php
- index()          → Show voting page (candidates)
- store()          → Save voting (with validation)
- hasil()          → Show voting results
```

### LaporanController
```php
- index()          → Show laporan
- exportCsv()      → Generate CSV export
- resetVoting()    → Show reset confirmation
- confirmReset()   → Process reset
```

---

## 🛡️ MIDDLEWARE ARCHITECTURE

### Middleware Chain
```
Request
  ↓
└─→ Authentication (Laravel built-in)
     ├─ Check if user logged in
     └─ Store auth in request
  ↓
└─→ IsAdmin (custom)
     ├─ Check if role === 'admin'
     └─ Deny mahasiswa access
  ↓
└─→ IsMahasiswa (custom)
     ├─ Check if role === 'mahasiswa'
     └─ Deny admin access
  ↓
Controller → Business Logic
```

---

## 🗃️ DATABASE SCHEMA

### Entity Relationship Diagram
```
users
├─ id (PK)
├─ name
├─ email (UNIQUE)
├─ password
├─ role (ENUM)
└─ timestamps

mahasiswa
├─ id (PK)
├─ nim (UNIQUE)
├─ nama
├─ jurusan
├─ angkatan
├─ user_id (FK) ──────┐
└─ timestamps         │
                      │ 1:1
users.id ◄────────────┘

kandidat
├─ id (PK)
├─ nama_kandidat
├─ visi
├─ misi
├─ foto
└─ timestamps

voting
├─ id (PK)
├─ mahasiswa_id (FK, UNIQUE) ──┐
├─ kandidat_id (FK) ───────┐   │
└─ timestamps              │   │
     │                     │   │
     │ Many-to-One        │   │ One-to-One
     ↓                    ↓   │
kandidat.id         mahasiswa.id
                          ▲
                          │ 1:1
                    users.id
```

---

## 🔄 FORM VALIDATION FLOW

```
Form Submission
     ↓
Controller Method
     ↓
$request->validate([
    'field' => 'rules'
])
     ├─ Valid → Proceed
     └─ Invalid → Back with errors

Validation Rules:
- required          ← Field harus ada
- email             ← Format email
- unique:table      ← Unique di database
- image|mimes:jpeg  ← File validation
- max:2048          ← File size
- password_confirmed← Password match
```

---

## 📁 FILE UPLOAD HANDLING

```
Form with enctype="multipart/form-data"
     ↓
$request->file('foto')
     ↓
Validation
├─ Mime type check
├─ Size check
└─ Storage disk check
     ↓
$request->file('foto')->store('kandidat', 'public')
     ├─ Save to storage/app/public/kandidat/
     └─ Return path: kandidat/filename.ext
     ↓
Storage link
└─ Symlink: public/storage → storage/app/public
     ↓
Access via: /storage/kandidat/filename.ext
```

---

## 🎨 VIEW ARCHITECTURE

### Master Layout (app.blade.php)
```
- Navigation bar (dynamic based on role)
- Alert/flash messages
- Content section (@yield)
- Footer
- JavaScript includes
```

### Blade Components
```
- Forms (@csrf, @error, @method)
- Tables (with pagination)
- Cards (with gradients)
- Charts (Chart.js)
- Alerts (Bootstrap)
```

---

## 🔐 SECURITY IMPLEMENTATION

```
Input Level
├─ HTML form validation (client-side)
└─ Browser-side only (not secure)

Server Level
├─ Validation in controller
├─ Type casting in models
└─ Sanitization

Database Level
├─ Foreign key constraints
├─ Unique constraints
└─ Data integrity

Application Level
├─ Authorization (middleware)
├─ Authentication (session)
├─ CSRF tokens
└─ Password hashing (bcrypt)

Output Level
├─ Blade escaping ({{ }} vs {!! !!})
└─ XSS prevention
```

---

## 📊 VOTING SYSTEM LOGIC

```
Voting Process:
1. User access /voting
   ├─ Check: mahasiswa->hasVoted()
   ├─ Query: Voting::where('mahasiswa_id', $id)->exists()
   └─ Result: true/false

2. If not voted, show candidates
   ├─ Query: Kandidat::all()
   └─ Include: withCount('voting')

3. User submit voting
   ├─ Validate: kandidat exists
   ├─ Validate: not already voted
   └─ Create: Voting record

4. Constraint: unique mahasiswa_id
   ├─ Database: UNIQUE KEY on mahasiswa_id
   └─ Prevents: duplicate voting
```

---

## 🚀 PERFORMANCE OPTIMIZATION

### Database Queries
```php
// Eager loading (prevent N+1)
Kandidat::withCount('voting')->get()

// Pagination (limit results)
Mahasiswa::paginate(10)

// Search/Filter (use indexes)
where('nim', 'like', "%$search%")
```

### Caching
```php
// Future: implement caching
// Cache::remember('kandidat_votes', 60, function() {
//     return Kandidat::withCount('voting')->get();
// })
```

### Indexes
```sql
-- Existing indexes in migrations
CREATE INDEX idx_user_id ON mahasiswa(user_id)
CREATE INDEX idx_mahasiswa_id ON voting(mahasiswa_id)
CREATE INDEX idx_kandidat_id ON voting(kandidat_id)
```

---

## 🧪 TESTING ARCHITECTURE (Future)

```
tests/
├── Unit/
│   ├── Models/
│   │   ├── UserTest.php
│   │   ├── MahasiswaTest.php
│   │   ├── KandidatTest.php
│   │   └── VotingTest.php
│   └── Controllers/
│       ├── AuthControllerTest.php
│       └── VotingControllerTest.php
│
└── Feature/
    ├── AuthTest.php
    ├── VotingTest.php
    └── AdminTest.php
```

---

## 📈 SCALABILITY CONSIDERATIONS

```
Current:
├─ Single server deployment
├─ SQLite or MySQL
└─ File storage (local)

Future Improvements:
├─ Database optimization (sharding)
├─ Redis caching (for voting results)
├─ Queue jobs (for reports export)
└─ Cloud storage (AWS S3 for files)
```

---

## 🔧 DEPLOYMENT ARCHITECTURE

```
Development
├─ php artisan serve
└─ Local database

Production
├─ Web Server (Apache/Nginx)
├─ PHP-FPM
├─ MySQL Database
└─ SSL/HTTPS
```

---

**Versi**: 1.0  
**Status**: Complete  
**Last Updated**: 2024-04-22
