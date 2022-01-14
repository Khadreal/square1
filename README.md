<p align="center"><a href="https://square1.factorialhr.com/" target="_blank"><img src="https://www.notion.so/image/https%3A%2F%2Fs3-us-west-2.amazonaws.com%2Fsecure.notion-static.com%2F334f6f31-9321-48d9-b03a-54be6a60b556%2F91470814224_1da55a8ce7e4027cbba6_132.jpg?table=block&id=0cdf0bb1-015d-4e5c-94b6-2b3fe61ee621&spaceId=036584dc-1616-4e3f-ba0b-d07c83a4c7a0&width=250&userId=&cache=v2" width="400"></a></p>

## How to set this up

##### Step 1:
Clone this repo and run composer install to install packages.

##### Step 2:
- Run migration with `php artisan migration`
- Run seed `php artisan db:seed`
- Run `php artisan serve` to view app on browser

#### To run test
- Run `php artisan test`

#### To fetch external post
- Run `php artisan external:post `

There's a scheduler to run this command every hour and log to file if failed or not complete