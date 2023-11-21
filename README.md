# eProtocol

eProtocol is a comprehensive application designed for streamlined digital management and organization of the registration process within an organization or institution.

The eProtocol program encompasses essential tools for coordinating, monitoring, and organizing an organization's protocol process, ensuring efficiency and reliability.

## 💡 Key Features

- **Recording Functionality**: Capture and manage both incoming and outgoing documents seamlessly.
- **Efficient Search Capability**: Easily search and track registered protocols for quick access.
- **Categorization System**: Organize protocols efficiently through effective categorization methods.
- **Document Digitization**: Convert physical documents into digital formats for enhanced accessibility.
- **Robust Document Security**: Ensures secure storage of documents to maintain confidentiality.

## 👨‍💻 Author
This laravel application was developed by **Andrei-Robert Tica** (**Αντρέϊ-Ρομπερτ Τσίκα**).

## ⚙️ Installation
To install the application on your server, follow the steps below:
>For instructions on how to set up a server using the LEMP stack, please refer to the following document: [Install guide.](INSTALL.md)

**Clone the Project**
```shell
git clone https://github.com/TsikaAndreas/eprotocol.git
```
**Install Dependencies**
```shell
composer install
```
**Update Dependencies (Optional)**

In case you want to update the packages to the latest version
```shell
composer update
```
**Generate Application Key**
```shell
php artisan key:generate
```
**Configure .env File**

Before proceeding (with the migrations/seeders), configure the .env file with your application settings.
> You will find a quick description of the `.env` file at the [Installation guide](INSTALL.md) 
> in the following section '**Set environments variables in the .env project file**'.

**Run Migrations**
```shell
php artisan migrate
```
**Run Seeders (Optional)**
```shell
php artisan db:seed
```
**Install Node Modules**
```shell
npm install
```
**Run Production Script**
```shell
npm run prod
```

Now, you can log in to the application using the following admin credentials:

- Email: `admin@admin.com`
- Username: `Administrator`
- Password: `Admin123!@#`

For detailed information on configuring the .env file and other setup nuances, please refer to the comprehensive Installation guide provided in the project documentation: [Install guide.](INSTALL.md).
