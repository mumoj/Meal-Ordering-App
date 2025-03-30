# SuCasa Eatery - Meal Ordering Application

A PHP web application for ordering meal deliveries within Moi University environs.

## Overview

SuCasa Eatery is a food ordering system that allows customers to:
- Browse menu items
- Create accounts and log in
- Order meals for delivery
- Receive email confirmations with invoice PDFs

## Features

- **User Authentication**
  - Registration system with email verification
  - Secure login functionality
  - Password reset/change capabilities

- **Menu Management**
  - Display available food items with prices
  - Dynamically generated menu (stored in database)
  - PDF menu generation

- **Order System**
  - Multi-item order capability 
  - Quantity selection
  - Order summary
  - Flat-rate delivery fee (Ksh 50)

- **Invoice Generation**
  - Automatic PDF invoice creation
  - Email delivery to customer
  - Order tracking

## Technical Stack

- **Frontend**: HTML, CSS, Bootstrap
- **Backend**: PHP
- **Database**: MySQL
- **Email**: PHPMailer
- **PDF Generation**: FPDF

## Directory Structure

```
├── DestroySession.php      # Session termination
├── FormErrors.php          # Error display component
├── README.md               # Project documentation
├── change-password1.php    # Password reset (email verification)
├── change-password2.php    # Password reset (new password)
├── enter-password.php      # Set password for new accounts
├── index.php               # Landing page
├── invoice.php             # Invoice generation
├── log-in.php              # Authentication
├── menu.php                # Food menu display
├── order.php               # Order placement
├── signup-customer.php     # New user registration
├── libraries/              # External libraries
│   ├── bootstrap.min.css   # Bootstrap CSS
│   ├── bootstrap.bundle.min.js # Bootstrap JS
│   ├── font-awesome.min.css # Font icons
│   ├── fonts/              # Custom fonts
│   ├── fpdf/              # PDF generation library
│   ├── PHPMailer-master/   # Email functionality
│   └── ...
```

## Database Schema

### Main Tables

#### Customer
- `customer_id` (Primary Key)
- `customer_name`
- `mobile_number`
- `customer_email`
- `password`

#### Menu
- `item_id` (Primary Key)
- `item_name`
- `price`
- `description`

## Setup Instructions

### Prerequisites
- PHP 7.0 or higher
- MySQL/MariaDB
- Web server (Apache/Nginx)
- SMTP access for email functionality

### Installation

1. Clone the repository:
   ```
   git clone https://github.com/yourusername/a-meal-ordering-app.git
   ```

2. Import the database schema:
   ```
   mysql -u username -p sucasa_db < database.sql
   ```

3. Configure the database connection:
   Edit connection parameters in PHP files to match your environment:
   ```php
   $Conn = new mysqli('Localhost', 'root', '', 'sucasa_db');
   ```

4. Configure email credentials:
   Edit the SMTP settings in `invoice.php`:
   ```php
   $mail->Host = 'smtp.gmail.com';
   $mail->Username = 'your-email@gmail.com';
   $mail->Password = 'your-password';
   ```

5. Ensure write permissions for PDF generation:
   ```
   chmod 755 /path/to/directory
   ```

## Usage

1. Start by accessing the home page (index.php)
2. New users should register via the "Sign Up" link
3. Returning users can log in with their credentials
4. Browse the menu or directly make an order
5. Select food items and quantities
6. Receive invoice by email
7. Food will be delivered to your location within Moi University


## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open source and available under the [MIT License](LICENSE).


