# Task Manager #
## Requirements ##
- Composer
- A database connection
## Setting up the project ##
- Git clone the project to your location of choice
- Navigate to the cloned folder and in config/packages/doctrine.yaml edit the dbal host, port, user, password, driver and server_version to your database connection settings
- Import the dbdump (dbdump.sql) into your database
- Open a terminal and navigate to the cloned folder
- Run the project locally by running php bin/console server:run
- The project should now be accessible on 127.0.0.1:8000