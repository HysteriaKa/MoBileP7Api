# MoBileP7Api
<!-- ABOUT THE PROJECT -->
## About The Project

This project is the Openclassroom P7 in symfony/Php course.

Expose an API.

Only users registered can access Api and get a list of products and a list and details of their ownn customers.

This app been developed with Symfony and Api plateform.





### Built With

Symfony 5.3

Php = 8.0.13



<!-- GETTING STARTED -->
## Getting Started

You have to clone this project

### Prerequisites

* git
  ```sh
  git clone https://github.com/HysteriaKa/MoBileP7Api.git
  ```

You will have to run 
* composer
  ```sh
  composer install
  ```

### Installation

You need to put the .env file in the main file. (deliverables OC).

The database is also in the deliverables.

or you can use the fixture by running 

   ```sh
   
php bin/console doctrine:fixtures:load
   ```

You can create as many users as you need in database by running this command 
   ```sh
   
php bin/console app:create-user email@email.com 1password
   ```
I use lexit JWT Authentication bundle [https://github.com/lexik/LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle)

You will have to generate your keys with this command 
   ```sh
   
$ php bin/console lexik:jwt:generate-keypair
   ```

<!-- USAGE EXAMPLES -->
## Usage

This app is made to learn how to expose APi with Symfony.
Documentation Api is accessible at localhost/api




<!-- LICENSE -->
## License

It's all free if it can help anyone running this course.



<!-- CONTACT -->
## Contact


Project Link: [https://github.com/HysteriaKa/MoBileP7Api.git](https://github.com/HysteriaKa/MoBileP7Api.git)

[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=HysteriaKa_MoBileP7Api&metric=security_rating)](https://sonarcloud.io/summary/new_code?id=HysteriaKa_MoBileP7Api)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=HysteriaKa_MoBileP7Api&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=HysteriaKa_MoBileP7Api)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/8dd5e9119b4e45aca2540e83b1ee3832)](https://www.codacy.com/gh/HysteriaKa/MoBileP7Api/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=HysteriaKa/MoBileP7Api&amp;utm_campaign=Badge_Grade)


