# Marrakech Budget Tours

A modern travel and tour booking website built with Laravel, featuring destination packages, blog posts, and contact functionality.

## Author
**Ahmed Hmimida**

## Project Overview
Marrakech Budget Tours is a comprehensive travel website that allows users to:
- Browse and search for travel destinations
- View detailed package information
- Read travel blog posts
- Contact the company for bookings
- Book tours via WhatsApp integration

## Prerequisites
Before you begin, ensure you have the following installed:
- PHP >= 8.1
- Composer
- Node.js and NPM
- MySQL or MariaDB
- Git

## Installation Steps

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/marrakech-budget-tours.git
cd marrakech-budget-tours
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install NPM dependencies**
```bash
npm install
```

4. **Create environment file**
```bash
cp .env.example .env
```

5. **Generate application key**
```bash
php artisan key:generate
```

6. **Configure database**
Edit the `.env` file and set your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marrakech_budget_tours
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. **Run migrations and seeders**
```bash
php artisan migrate --seed
```

8. **Compile assets**
```bash
npm run dev
```

9. **Start the development server**
```bash
php artisan serve
```

## Features
- Responsive design for all devices
- Modern UI with smooth animations
- WhatsApp booking integration
- Blog system with categories and tags
- Contact form with email notifications
- Admin dashboard for content management
- Search functionality for destinations
- Image optimization and lazy loading

## Directory Structure
```
marrakech-budget-tours/
├── app/
│   ├── Http/
│   ├── Models/
│   └── Services/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── css/
│   ├── js/
│   └── images/
├── resources/
│   ├── views/
│   └── lang/
├── routes/
└── tests/
```

## Contributing
1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact
- **Name:** Ahmed Hmimida
- **Email:** [Your Email]
- **Website:** [Your Website]

## Acknowledgments
- Laravel Framework
- Bootstrap
- jQuery
- Font Awesome
- All contributors who have helped shape this project

### Screenshots

#### Homepage
<p float="left">
  <img src="https://github.com/muchaisam/Tours-Travel/blob/main/screenshots/6.png" width="auto" />
  <img src="https://github.com/muchaisam/Tours-Travel/blob/main/screenshots/7.png" width="auto" /> 
</p>

#### Destination Info and Cart Page
<p float="left">
  <img src="https://github.com/muchaisam/Tours-Travel/blob/main/screenshots/1.png" width="auto" />
  <img src="https://github.com/muchaisam/Tours-Travel/blob/main/screenshots/2.png" width="auto" /> 
</p>

#### Place Order
<p float="left">
  <img src="https://github.com/muchaisam/Tours-Travel/blob/master/screenshots/3.png" width="auto" />
</p>

#### Checkout
<p float="left">
  <img src="https://github.com/muchaisam/Tours-Travel/blob/main/screenshots/4.png" width="auto" />
</p>

#### Stripe Backend
<p float="left">
  <img src="https://github.com/muchaisam/Tours-Travel/blob/main/screenshots/5.png" width="auto" />
</p>

#### Blog
<p float="left">
  <img src="https://github.com/muchaisam/Tours-Travel/blob/main/screenshots/8.png" width="auto" />
</p>

#### Backend
<p float="left">
  <img src="https://github.com/muchaisam/Tours-Travel/blob/main/screenshots/b.png" width="auto" />
</p>
