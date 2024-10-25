# Blogs CMS
Blog management system.

## Setup Instructions

1. Rename the `.env.example` file to `.env` and update your database details:

   1. DB_DATABASE=your_database_name
   2. DB_USERNAME=your_database_user
   3. DB_PASSWORD=your_database_password

2. Run the following commands to set up the project:

   1. composer install
   2. php artisan key:generate
   3. npm install
   4. php artisan migrate
   5. php artisan db:seed
   6. php artisan storage:link

3. Admin login details

   1. email : admin@admin.com
   2. password : admin@1234

4. User login details

   1. email : user@user.com
   2. password : user@1234

5. Start the local server (If you are using windows make sure xaamp server is running):

   1. php artisan serve
   2. npm run dev
