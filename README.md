## About eProtocol

It is an application for the digital management and organisation of the registration process in an organisation/institution.

An e-Protocol program includes all the necessary tools to coordinate, monitor and organise an organisation's protocol process.

It is the most suitable solution for the management of protocols, as it offers the possibility of recording any digital document, which simplifies the process of searching and tracking them.

Basic management functions of the e-Protocol application:
- Recording incoming and outgoing documents.
- Ability to search for registered protocols.
- Categorisation of protocols.
- Digitisation of documents.
- Document storage security.

---
## 👨‍💻 Author
>This laravel application was developed by **Andrei-Robert Tica** (**Αντρέϊ-Ρομπερτ Τσίκα**).

---
## ⚙️ Installation

In the following guide I will explain how to install the application on a running server.<br>
For instructions on how to set up a server using the LEMP stack, please refer to the following document: [Install guide.](INSTALL.md)

Add the project via git or by download the zip version:
```shell
git clone https://github.com/TsikaAndreas/eprotocol.git
```
Install the `vendor` directory that contains the dependencies packages:
```shell
composer install
```
In case you want to update the packages to the latest version run the following command:
```shell
composer update
```
Generate the application key:
```shell
php artisan key:generate
```
>**Note**: Before running any migrations/seeders you need to configure the `.evn` file in your application.
> You will find a quick description of the `.env` file at the [Installation guide](INSTALL.md) 
> in the following section '**Set environments variables in the .env project file**'.

Run the migrations:
```shell
php artisan migrate
```
Run the seeders:
```shell
php artisan db:seed
```
Install the missing `node_modules` directory that contains all the modules:
```shell
npm install
```
Run the production script:
```shell
npm run prod
```

Now you can log in the app with the following admin credentials:

- Email: `admin@admin.com`
- Username: `Administrator`
- Password: `Admin123!@#`
