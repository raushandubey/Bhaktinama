# Bhaktinama.com - Online Pandit Booking Platform

A modern, responsive web application for booking Hindu religious services and connecting devotees with qualified Pandits. Built with Laravel 12.0 and modern web technologies.

![Bhaktinama Logo](public/images/bhaktinama_logo-removebg-preview.png)

## 🌟 Features

### 🔐 User Authentication & Management
- **Secure Registration**: Complete user registration with validation
- **Login System**: Email-based authentication with "Remember Me" functionality
- **User Profiles**: Store user details including mobile, address, and date of birth
- **Session Management**: Secure session handling with CSRF protection

### 📅 Booking System
- **Multiple Puja Types**: Satyanarayan, Griha Pravesh, Vahana, Lakshmi Ganesh, Rudrabhishek, Marriage Ceremony
- **Real-time Scheduling**: Date and time slot selection with availability checking
- **Pandit Selection**: Choose from verified Pandits with ratings and reviews
- **Booking History**: Complete booking management and history tracking

### 🎨 Modern UI/UX
- **Responsive Design**: Mobile-first approach with touch-friendly interface
- **Smooth Animations**: CSS animations and scroll-triggered effects
- **Interactive Elements**: Hover effects, transitions, and modern styling
- **Quick Booking**: Streamlined booking process for logged-in users

### 📱 Mobile Optimization
- **Touch-Friendly**: Optimized for mobile devices and tablets
- **Responsive Grid**: Adaptive layouts for all screen sizes
- **Fast Loading**: Optimized assets and efficient code structure

## 🛠️ Technology Stack

### Backend
- **PHP**: ^8.2
- **Laravel**: ^12.0 (Latest)
- **MySQL**: Database management
- **Composer**: Dependency management

### Frontend
- **HTML5**: Semantic markup
- **CSS3**: Modern styling with Flexbox and Grid
- **JavaScript**: ES6+ with modern features
- **Font Awesome**: 6.4.0 for icons

### Development Tools
- **Laravel Artisan**: Command-line interface
- **Laravel Mix**: Asset compilation
- **Git**: Version control

## 📋 Prerequisites

Before you begin, ensure you have the following installed:
- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **MySQL**: 5.7 or higher
- **Node.js**: 14 or higher (for asset compilation)
- **Git**: For version control

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/bhaktinama.git
cd bhaktinama/project
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup
Edit your `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bhaktinama
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migrations and Seeders
```bash
php artisan migrate
php artisan db:seed
```

### 6. Set Permissions (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

### 7. Start Development Server
```bash
php artisan serve
```

Visit `http://localhost:8000` to see your application.

## 🗄️ Database Structure

### Users Table
- `id` - Primary key
- `name` - User's full name
- `email` - Unique email address
- `mobile` - Contact number
- `dob` - Date of birth
- `address` - User's address
- `password` - Hashed password
- `created_at`, `updated_at` - Timestamps

### Additional Tables
- `password_reset_tokens` - Password reset functionality
- `sessions` - User session management

## 🎯 Usage Guide

### For Users

#### 1. Registration
- Visit the homepage and click "Signup"
- Fill in your details (name, email, mobile, address, password)
- Verify your information and submit

#### 2. Booking a Puja
- **Option A**: Click "Book Now" on any puja card
- **Option B**: Use "Quick Book" section (if logged in)
- Select your preferred date and time
- Choose a Pandit from the available options
- Review and confirm your booking

#### 3. Managing Bookings
- View all bookings in "My Bookings" section
- Check booking status and details
- Access booking history

### For Administrators

#### 1. User Management
- Monitor user registrations
- View booking statistics
- Manage user accounts

#### 2. Booking Management
- Track all bookings
- Update booking status
- Generate reports

## 🔧 Configuration

### Environment Variables
Key configuration options in `.env`:

```env
APP_NAME="Bhaktinama.com"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bhaktinama
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### Customization
- **Logo**: Replace `public/images/bhaktinama_logo-removebg-preview.png`
- **Colors**: Modify CSS variables in `public/css/style.css`
- **Pujas**: Update puja list in `resources/views/index.blade.php`

## 🚀 Deployment

### Shared Hosting Deployment

#### 1. Prepare Your Application
```bash
# Build for production
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### 2. Upload Files
- Upload all files to your hosting directory
- Ensure `storage` and `bootstrap/cache` are writable

#### 3. Configure Database
- Create MySQL database on your hosting
- Update `.env` with production database credentials

#### 4. Set Permissions
```bash
chmod -R 755 storage bootstrap/cache
```

### VPS/Cloud Deployment

#### 1. Server Setup
```bash
# Update system
sudo apt update && sudo apt upgrade

# Install required packages
sudo apt install nginx mysql-server php8.2-fpm php8.2-mysql php8.2-mbstring php8.2-xml php8.2-curl composer
```

#### 2. Nginx Configuration
Create `/etc/nginx/sites-available/bhaktinama`:
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/bhaktinama/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

#### 3. Enable Site
```bash
sudo ln -s /etc/nginx/sites-available/bhaktinama /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

#### 4. SSL Certificate (Let's Encrypt)
```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d your-domain.com
```

## 🔒 Security Features

- **CSRF Protection**: All forms protected against CSRF attacks
- **Password Hashing**: Secure password storage using Laravel's Hash facade
- **Input Validation**: Server-side validation for all user inputs
- **Session Security**: Secure session management with regeneration
- **SQL Injection Protection**: Laravel's Eloquent ORM protection
- **XSS Protection**: Automatic output escaping

## 🧪 Testing

### Test Accounts
The application comes with pre-seeded test accounts:

```
Email: test@example.com
Password: password123

Email: john@example.com
Password: password123

Email: jane@example.com
Password: password123
```

### Running Tests
```bash
php artisan test
```

## 📊 Performance Optimization

### Production Optimizations
```bash
# Cache configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

### Database Optimization
- Index frequently queried columns
- Use database connection pooling
- Implement query caching where appropriate

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Developer

**Raushan Dubey**
- **Email**: [raushandubey2005@gmail.com]
- **GitHub**: [https://github.com/raushandubey]
- **LinkedIn**: [https://www.linkedin.com/in/raushan-dubey01/]

## 🙏 Acknowledgments

- **Laravel Team**: For the amazing PHP framework
- **Font Awesome**: For the beautiful icons
- **Open Source Community**: For inspiration and support
- **All Contributors**: Who helped in building this project

## 📞 Support

For support, email [raushandubey2005@gmail.com] or create an issue in the GitHub repository.
mobile no : +91 9934898643
Whatsapp no : +91 6206507445

**Made with ❤️ by Raushan Dubey**

*Bhaktinama.com - Connecting Devotees with Divine Services* 