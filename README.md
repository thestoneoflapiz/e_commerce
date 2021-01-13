# Technologies Used

1. Composer 
2. Laravel 8.12
3. NowUI Kit and Admin Dashboard(Bootstrap 4)

# Simple E-Commerce App: What to expect?

User types: 

1. Buyer
    - Can register
    - Can add to cart
    - Can checkout

2. Seller
    - Can register  
    - Create and edit items
    - Can check the item that is sold

3. Admin
    - Can approve pending items from sellers
    - Can change privilege (make seller able to buy items)

Notes:
1. All users can login in the same login page but the dashboard page is unique to their type and functionality.
2. The landing page is where: 
    - All approved items are displayed.
    - Index of the website
3. Only buyers or sellers(buyer privilege) are able to add to cart/buy items.


# How to run this project on your local machine

Note:
- Make sure you have installed `git`, `php`, `mysql`, `phpmyadmin`, and `composer` that are up to date 01-2020(Jan 2021)
- It's better to use Visual Studio Code to run and test this project and use it's terminal at `ctrl + j`

1. Clone this project to your local machine
2. Open your terminal and go to the project's directory
3. Type `composer install`
4. Edit your `.env` and settle your application and database variables
5. Type `php artisan migrate:fresh --seed` 
6. Type `php artisan serve`
7. Visit your project at `http://127.0.0.1:8000`
8. Test the system. Thank you!