### Backend Repo for Unit Nukleus GovTech, Kem Digital
Stack: PHP 8.1, Laravel 10

## Notes
The junior and mid/senior tasks have been tackled separately. Hence the controller file are separated. For junior tasks, the controller is ProductController. For mid/ senior tasks, the controller are ExtendedProductController and PermissionController.

For the roles, 3 values are seeded: guest, admin and free-role which are assign to user 1, user 2 and user 3 respectively. For permissions, the values seeded are: product-list, product-create, product-edit and product-delete.

For installation of Laravel, the installation can be referred from [here](https://laravel.com/docs/10.x/installation). I recommend the installation of dbngin with Laravel Herd.

To run all the tests
`
php artisan migrate:fresh --seed --env = testing // for first timer
`
`php artisan test // to run all the test
`

##  Tasks Backend (Junior)

- [x]   /api/inventory . Query param for both category filter and sorting done but not implemented in the front end. Pagination has been implemented in the backend but not in the frontend.
- [x]   /api/inventory/product-id . Implemented in backend but not in the front end. For front end, clicking the view/edit button will show a dialogue with all the product information.
- [x] /api/add-inventory to add a product 
- [x] /api/delete-inventory to remove a product. The api has been changed into /api/delete-inventory/product-id 
- [x] /api/update-inventory to update a product or supplier. The api has been changed into api/update-inventory/product-id
- [x] Run `php artisan db:seed -class=ProductSeeder` to populate the products table with 1000 records

##  Tasks Backend (Mid/ Senior)
Since no login is required, the user information is being passed as a route parameter in each api route.

- [x]   /api/user-id/inventory . Query param for both category filter and sorting done but not implemented in the front end. Pagination has been implemented in the backend but not in the frontend.
- [x]   /api/user-id/inventory/product-id . Implemented in backend but not in the front end. For front end, clicking the view/edit button will show a dialogue with all the product information.
- [x] /api/user-id/add-inventory to add a product 
- [x] /api/user-id/delete-inventory to remove a product. The api has been changed into /api/delete-inventory/product-id 
- [x] /api/user-id/update-inventory to update a product or supplier. The api has been changed into api/update-inventory/product-id
- [x] /api/user-id/permissions to get all the permissions for a given user and also used to update the permission
- [x] Run `php artisan db:seed -class=ProductSeeder` to populate the products table with 1000 records
