

<h1 align="center" style="font-weight: bold;">Luminate 🗓</h1>

<p align="center">
<a href="#tech">Technologies</a>
<a href="#started">Getting Started</a>

</p>

<p align="center">Luminate is an intuitive project management system designed to streamline the management of projects, meetings, and tasks.</p>

<p align="center">
<a href="https://youtu.be/pxOwHbiqo80">💻 Demo video</a>
</p>

<h2 id="layout">🎨 Layout</h2>

<p align="center">

<img src="https://i.ibb.co/sFbvGbM/Screenshot-1.jpg" alt="Screenshot" width="400px">
</p>

<h2 id="technologies">💻 Technologies</h2>

- php 8
- Laravel 10

<h2 id="started">🚀 Getting started</h2>

follow these simple example steps to get a local copy up and running. 

<h3>Prerequisites</h3>

This project requires php 8, Laravel 10, and Composer to be installed in your system. If you don't have it installed, you can follow these links::

- [Laravel 10](https://laravel.com/docs/10.x/readme)
- [PHP 8](https://www.php.net/releases/8.0/en.php)
- [Composer](https://getcomposer.org/)

<h3>Cloning</h3>

Get started by cloning the repository to your local machine

```bash
git clone https://github.com/HamzaEsadik/Luminate.git
```

<h3>Starting</h3>

- Run the frontend

[Frontend](https://github.com/HamzaEsadik/luminate_frontend)

- Install backend Packages:

```bash
cd Luminate
composer install
```

- Setup .env file:
  
  1. Duplicate the .env.example file and rename it to .env.
  2. Update the necessary environment variables such as database credentials, application key, etc.

- Generate Application Key

```bash
php artisan key:generate
```

- Run migrations

```bash
php artisan migrate
```

- Run developement server:

```bash
php artisan serve
```

<h2 id="contribute">📫 Contribute</h2>

Thank you for your interest in contributing to this project. At this time, we are not accepting external contributions. However, we appreciate your enthusiasm and encourage you to use the project, provide feedback, and share your thoughts.

<h3>Documentations that might help</h3>

[Laravel](https://laravel.com/docs/10.x/readme)
