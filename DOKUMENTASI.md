# Aplikasi Peminjaman Alat

Sistem Informasi Peminjaman Alat berbasis Laravel 12 dengan 3-level role-based access control (Admin, Petugas, Peminjam).

## 🎯 Fitur Utama

### Admin
- ✅ Dashboard dengan ringkasan statistik
- ✅ Kelola Pengguna (CRUD) - Create, Read, Update, Delete users
- ✅ Kelola Alat (CRUD) - Manage equipment inventory
- ✅ Kelola Kategori (CRUD) - Manage equipment categories
- ✅ Lihat Log Aktivitas - Track all system activities

### Petugas
- ✅ Dashboard Petugas
- ✅ Kelola Peminjaman - Approve/Reject loan requests
- ✅ Kelola Pengembalian - Process equipment returns

### Peminjam
- ✅ Dashboard Peminjam
- ✅ Lihat Daftar Alat - Browse available equipment
- ✅ Riwayat Peminjaman - View loan history
- ✅ Ajukan Peminjaman - Submit new loan requests

## 📋 Teknologi Stack

- **Framework**: Laravel 12 (PHP 8.2)
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Blade Templates
- **Authentication**: Laravel built-in auth with role-based middleware
- **Code Quality**: Laravel Pint (PSR-12)

## 🗄️ Database Structure

### Tables
1. **users** - User accounts dengan role (admin, petugas, peminjam)
2. **kategoris** - Equipment categories
3. **alats** - Equipment inventory
4. **peminjamans** - Loan records
5. **pengembalians** - Return records
6. **log_aktivitas** - System activity logs

## 🚀 Setup & Installation

### Prerequisites
- PHP 8.2+
- MySQL Server
- Composer
- Node.js (for asset compilation)

### Installation Steps

```bash
# 1. Clone repository
cd /path/to/peminjaman-alat

# 2. Install dependencies
composer install

# 3. Copy environment file
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Configure database in .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_DATABASE=peminjaman_alat
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Run migrations
php artisan migrate

# 7. Seed database with sample data
php artisan db:seed

# 8. Start development server
php artisan serve

# 9. Access application at http://localhost:8000
```

## 👤 Demo Credentials

### Admin
- Username: `admin`
- Password: `password`

### Petugas
- Username: `petugas1` atau `petugas2`
- Password: `password`

### Peminjam
- Multiple test users available in database
- Password: `password`

## 📁 Project Structure

```
peminjaman-alat/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/           # Authentication controllers
│   │   │   ├── Admin/          # Admin controllers
│   │   │   ├── Petugas/        # Petugas controllers
│   │   │   └── Peminjam/       # Peminjam controllers
│   │   └── Middleware/         # Role-based middleware
│   ├── Models/                 # Eloquent models
│   └── Providers/
├── database/
│   ├── migrations/             # Database migrations
│   ├── factories/              # Model factories
│   └── seeders/                # Database seeders
├── resources/
│   └── views/
│       ├── layouts/            # Layout templates
│       ├── auth/               # Authentication views
│       ├── admin/              # Admin views
│       ├── petugas/            # Petugas views
│       └── peminjam/           # Peminjam views
├── routes/
│   ├── web.php                 # Web routes
│   └── console.php             # Console routes
└── tests/                       # Test files
```

## 🔐 Security Features

- Password hashing using bcrypt
- CSRF protection on all forms
- Role-based access control (middleware)
- SQL injection prevention (Eloquent ORM)
- Activity logging for audit trail

## 📊 Sample Data Included

### Users
- 1 Admin user
- 2 Petugas users
- 5 Peminjam users

### Equipment Categories
- Elektronik
- Peralatan Listrik
- Fotografi
- Perkakas
- Komputer

### Equipment
- 8 equipment items across different categories
- Dengan status kondisi (Baik, Rusak, Hilang)

## 🧪 Testing

```bash
# Run all tests
php artisan test --compact

# Run specific test file
php artisan test tests/Feature/AuthenticationTest.php --compact

# Run tests with coverage
php artisan test --coverage
```

## 📝 Code Standards

Project menggunakan Laravel Pint untuk enforce PSR-12 code standards.

```bash
# Format code
vendor/bin/pint

# Check code without fixing
vendor/bin/pint --test
```

## 🛠️ Development Commands

```bash
# Clear application cache
php artisan cache:clear

# Clear config cache
php artisan config:clear

# Database
php artisan migrate:fresh --seed    # Reset database with fresh seed
php artisan migrate:rollback         # Rollback last migration batch

# Generate resources
php artisan make:model ModelName
php artisan make:controller ControllerName
php artisan make:migration create_table
```

## ⚙️ Configuration

### .env file important keys
```
APP_NAME="Peminjaman Alat"
APP_ENV=local
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=peminjaman_alat
DB_USERNAME=root
DB_PASSWORD=
```

## 🚨 Troubleshooting

### Issue: Routes not working
- Run: `php artisan cache:clear` and `php artisan config:clear`

### Issue: Database connection error
- Ensure MySQL is running
- Check DB credentials in .env file
- Run: `php artisan migrate`

### Issue: Assets not loading
- Run: `npm run build` for production
- Run: `npm run dev` for development

## 📖 Documentation

Full API and detailed documentation coming soon.

### Existing Features (Ready to Use)
- User Authentication System
- Role-based Dashboard Access
- CRUD Operations for Admin
- Activity Logging
- Bootstrap UI/UX

### TODO Features
- Peminjaman Workflow (Approval system)
- Pengembalian dengan kondisi tracking
- Notification System
- PDF Report Generation
- SMS Notifications
- API Documentation

## 👨‍💻 Developer Notes

### Code Patterns
- Use Eloquent relationships heavily
- Follow Laravel conventions
- Use route model binding
- Implement proper validation

### Database Query Optimization
- Use `with()` for eager loading
- Implement pagination for large datasets
- Use select/pluck for specific columns

### Future Improvements
1. Add email notifications
2. Implement SMS gateway integration
3. Create comprehensive API endpoints
4. Add real-time notifications with Pusher
5. Implement barcode/QR code scanning
6. Add dashboard charts and statistics
7. Implement recurring donations/reminders

## 📞 Support

For issues or questions, please check the existing documentation or contact the development team.

## 📄 License

This project is licensed under the MIT License.

---

**Last Updated**: April 9, 2026
**Application Status**: ✅ Core Features Complete & Functional
