<div align="center">
    <img src="https://raw.githubusercontent.com/CraigJWilliams/dearFutureMeApp/main/public/imgs/logo.png" alt="Dear Future Me Logo">
</div>

<h1 align="center">Dear Future Me</h1>

A full-stack application to send messages to your future self. This project was created for me to get to grips with using Laravel.
This web app functions as a digital time capsule, enabling users to send messages that remain locked until their chosen future date.

It features seamless account creation and notifies users via email when their message is ready to be opened.

## Screenshots

### Home Page
<img src="https://raw.githubusercontent.com/CraigJWilliams/dearFutureMeApp/main/public/imgs/homepage.png" alt="Home Page" width="600">

### Login
<img src="https://raw.githubusercontent.com/CraigJWilliams/dearFutureMeApp/main/public/imgs/loginpage.png" alt="Login Page" width="600">

### Dashboard
<img src="https://raw.githubusercontent.com/CraigJWilliams/dearFutureMeApp/main/public/imgs/dashboard.png" alt="Dashboard Page" width="600">

### Create Message
<img src="https://raw.githubusercontent.com/CraigJWilliams/dearFutureMeApp/main/public/imgs/createmessage.png" alt="Create Message Page" width="600">

### Message Confirmation
<img src="https://raw.githubusercontent.com/CraigJWilliams/dearFutureMeApp/main/public/imgs/messagesent.png" alt="Message Confirmation Page" width="600">


## Demo Video:
[Click here to watch a quick demo video](https://youtu.be/o0VtgBEXZMU)


## Prerequisites

Before you begin, ensure you have the following installed:
- PHP
- Composer
- npm
- MySQL

## Installation

1. **Clone the Repository**

   Clone the project repository by running the following command:

   ```bash
   git clone https://github.com/CraigJWilliams/dearFutureMeApp
   ```
   
2. **Change directory to your project folder**
    

   ```bash
    cd [your-repo-directory]
    ```
    
3. **Install Composer dependencies**

    Install the required Composer dependencies using:

    ```bash
    composer install
    ```
    
4. **Install NPM Packages**

    Install the required npm packages using:

    ```bash
    npm install
    ```
    
5. **Create a Copy of Your .env File**

    Duplicate the `.env.example` file to create your `.env` file. This file contains important configuration settings for your application.

    ```bash
    cp .env.example .env
    ```

6. **Generate an App Encryption Key**

    Generate a new application key. This will be added to your `.env` file and is used for encrypting user sessions and other sensitive data.

    ```bash
    php artisan key:generate
    ```

7. **Create an Empty Database**

    Create a new MySQL database for your application through your database management tool or command line.

8. **Configure your .env File**

    Open the `.env` file in a text editor and configure your database and mail server settings:

    ```
    # Database configuration
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=[your_database_name]
    DB_USERNAME=[your_database_username]
    DB_PASSWORD=[your_database_password]

    # Mail server configuration
    MAIL_MAILER=smtp
    MAIL_HOST=[your_mail_host]
    MAIL_PORT=[your_mail_port]
    MAIL_USERNAME=[your_email_username]
    MAIL_PASSWORD=[your_email_password]
    MAIL_ENCRYPTION=[mail_encryption_method]
    MAIL_FROM_ADDRESS=[your_from_email_address]
    MAIL_FROM_NAME="[your_email_from_name]"
    ```

9. **Migrate the Database**

    Run the migrations to create the necessary tables in your database:

    ```bash
    php artisan migrate
    ```

## Running the Application

1. **Start the Laravel Server**

    To start your Laravel application, run:

    ```bash
    php artisan serve
    ```
    
    and
    
    ```bash
    npm run dev
    ```

    This will start the server on `http://localhost:8000`.

2. **Accessing the Application**

    Open your web browser and navigate to `http://localhost:8000`.

## Contributing

Contributions to this project are welcome! Please fork the repository and submit a pull request with your changes.

## License

This project is licensed under the MIT license



