Web Developer Task
- Language: PHP
- Framework: Laravel.
- multi authentication system that has two types of users,
Admin and Supervisor.
• Admin authentication
• Supervisor authentication
Admin tasks
• CRUD for supervisors module (create/read/update/delete)
Supervisor data:
- Username
- Phone
- Email
- Avatar
- Password
• Multiple delete supervisors.
• Block/Unblock supervisor.
Supervisor tasks
1. Category CRUD
Category Data:
- Name
- Slug
- Icon Font Awesome
2. Multiple delete categories.
3. SOFT DELETE for deleting functions.
4. Product CRUD:
• Category
• Name
• Slug
• description
• image
• Product images
- to run Project 
1. run composer install
2. create new database and add it in .env file with username and password for this database
3. run php artisan serve 
4. can run php artisan db:seed to create demo data form all used models such : admin, supervisor, category, product
4. all default passwords used in app : 123456