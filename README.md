# magazine
magazine website built with laravel

### Demo  
* http://rocky-coast-75670.herokuapp.com/
* admin credentials: `email: test@test.com` And `password: 123`
* secondary admin credentials (can do like admin role but with limited role): `email: test1@test.com` And `password: 50505050` 
* normal user credentials: `email: test2@test.com` And `password: 80808080`

### Features(main features)
* Admin panel 
* different roles for each user (admin - secondary admin - normal user) 
* the ability to add likes , make reports , post , comment and so much more

### Getting started
* you do not have a .env file in the project root folder so copy .env.example and save it as .env
* In .env file update the database configuration
* Open the terminal or command prompt and navigate to the project directory and run `composer install`
* Generate a key using `php artisan key:generate`
* Clear the config cache by running `php artisan config:cache`
* Finally run `php artisan migrate`
* Go to the website and sign in by using admin credentials: `email: test@test.com` And `password: 123`

### Technologies
* Laravel 
* jQuery 
* Ajax 
* Bootstrap

### Packages
* [SweetAlert](https://github.com/t4t5/sweetalert)
* [laravelcollective](https://laravelcollective.com/docs/5.3/html)

### Plugins & Third party resources
* [TinyMCE](http://tinymce.com/)
* [Parsley](https://github.com/guillaumepotier/Parsley.js/)

