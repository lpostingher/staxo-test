# Staxo Test
It is a simple shop application, where the user can buy some products with credit card using `Stripe` integration.

This application use `Laravel Framework` with `Laravel Breeze`, which provides me all authentication mechanism and a simple frontend starter kit, with native HTML, CSS and Javascript. 

## Pages
### Unauthenticated user
- **Home:** At home page, the user can see and search all available products on application;
- **Product detail:** At this page, the user can see with more details the product image and realize a purchase. To realize a purchase, the user must inform a quantity and the e-mail address, for billing stuff;
- **Checkout:** After user click on `Buy` button at `Product detail` page, it'll be redirected to check out where it will show purchase information and payment form;
- **Confirmation:** With a success payment, the user will be redirected to a success page, which means that the first payment's half was successfully made. The second half will be processed after 5 minutes. A confirmation e-mail is sent after each step, with a simple order description.
### Authenticated user
- **Login:** At the right top corner there is a link named `Restricted area`, this links redirects to the `Login` page. This login is restricted for application managers. After a successful authentication, a button with the username will be shown in place off `Restricted area`. This button show a menu with some management options;
- **Profile:** This page allows user to manage some profile information like, name, e-mail, password and delete account;
- **Manage products:** In this page, the user can find and manage all products in application. The user can search, create, update and delete products;
- **Register new user:** For specification reasons, the application do not allow a guest user to register, only authenticated user can do it.

## Developer
### Dependencies
- PHP 8.1
- MySQL
- Composer
- Node
### Running the application
#### Environment
Be careful to check all important environment variables. The `.env.example` file will be a default configuration that you can use to you local environment. Just make a copy and rename it to `.env`.

Here is a list of the main required variables:
- For database connection
  - DB_CONNECTION
  - DB_HOST
  - DB_PORT
  - DB_DATABASE
  - DB_USERNAME
  - DB_PASSWORD
- For e-mail
  - MAIL_MAILER
  - MAIL_HOST
  - MAIL_PORT
  - MAIL_USERNAME
  - MAIL_PASSWORD
  - MAIL_ENCRYPTION
  - MAIL_FROM_ADDRESS
  - MAIL_FROM_NAME
- For Stripe Integration
  - STRIPE_API_KEY
  - STRIPE_API_SECRET_KEY
- For a correct queue work
  - QUEUE_CONNECTION=database

### Running the project
Composer dependencies.
> composer install

Node dependencies.
> npm install
> 
> npm run build

Execute the database migrations.
> php artisan migrate

Generate the application key.
> php artisan key:generate

Run the server. It'll run at http://127.0.0.1:8000.
> php artisan serve

Run queue monitoring
> php artisan queue:listen

Process queue once
> php artisan queue:work

### Running tests
For automated tests the project use `PHPUnit`.
> vendor/bin/phpunit

A coverage report is generated at `.html-coverage` folder at project root. The current coverage is `90.65%`.

### Code quality
For code quality the project use these libraries:
- PHPCS
- PHPCBF
- PHP Insights

There is a custom composer command that execute a command chain to help developer keep the code quality. This command is configured at `composer.json` file.
> composer check

### Sample data
Is possible to generate some sample data with database seed.
> php artisan migrate --seed

This seed will generate som products and an account to sign in into `Restricted area`. An account with following information will be generated.
> E-mail: account@example.com
> 
> Password: password
