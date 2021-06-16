# api-development-assessment
	This is a short coding assignment, to implement a REST API that calls an external API service to get information about books
	and a simple CRUD (Create, Read, Update, Delete) API with a local database
	
# Setup
	Clone this repo
	run composer install
	run cp .env.example .env or rename the .env.example file to .env and save
	run php artisan key:generate
	create a Database with the name testapp_db
	Then import the .sql file to your database in the project
	fill your appropriate Database credentials in the .env file
	run php artisan migrate
	run php artisan serve
	Visit your application on http://localhost:8000
