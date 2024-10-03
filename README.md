# Truck Management System Application

This Truck Management System application is built with Laravel and Vue.js. It provides a simple web interface to use truck management system. This document outlines the steps required to set up the application on your local development environment.

## Prerequisites

Before proceeding with the setup, ensure you have the following installed on your machine:

-   Docker
-   Docker Compose
-   Composer

## Setup

#### 1.  **Clone the Repository**
    
First, clone the repository to your local machine. Open a terminal and run the following command:
    
`git clone git@github.com:gediminasnn/laravel.vue.truck-management-system.git` 
    
(Optional) Replace `git@github.com:gediminasnn/laravel.vue.truck-management-system.git` with the URL of repository.
    
#### 2.  **Navigate to the Application Directory**
    
Change directory to the application root:
    
`cd laravel.vue.truck-management-system` 
    
(Optional) Replace `laravel.vue.truck-management-system` with the path where you cloned the repository.
    
#### 3.  **Prepare the Environment File**
    
Prepare the application's environment file. Locate the `env.example` file in the application root and create a new file named `.env` using it as a template. Optionally, edit the `.env` file to adjust any environment variables specific to your setup.

#### 4.  **Install Composer Dependencies**

Before starting the Docker containers, install the project's PHP dependencies using Composer. Open a terminal and navigate to your project directory. Then, run the following command:

`composer install`

This command downloads and installs all the PHP libraries your project requires based on the `composer.json` file.

#### 5.  **Start the Docker Containers**
    
Use Laravel Sail to start the Docker containers. Run the following command in your terminal:
    
`./vendor/bin/sail up` 
    
This command builds and starts all containers needed for the application. The first time you run this, it might take a few minutes to download and build everything.
    
#### 6.  **Setup Configuration Cache**

Before starting the Docker containers, cache the application's configuration for performance optimization. Open a new terminal from project root directory and run the following command:

`./vendor/bin/sail php artisan config:cache`

This command generates a cached file of all configuration values, which Laravel can load significantly faster than reading configuration files from disk every time. This improves the overall performance of the application.
    
#### 7.  **Run Migrations**
    
After the Docker containers are up and running, it's time to create the necessary database tables. In the terminal, execute the following command:
    
`docker exec -it laravelvuetruck-management-system-laravel.test-1 php artisan migrate` 
    
This command runs the migration files against the database to create the necessary tables for the application.

#### 8. **Run Database Seeds**

After successfully running the migrations, it's time to populate the database with some initial data, run the database seeder. Ensure your Docker containers are up and running. In the terminal, execute the following command:

`docker exec -it laravelvuetruck-management-system-laravel.test-1 php artisan db:seed`

This command will execute the seeders defined in your application, populating the database with sample or default data.

#### 9.  **Install Node.js Dependencies**
    
With the Docker containers up and running, you'll next need to install the Node.js dependencies required for the front-end part of the application. In the terminal, execute the following command:
    
`./vendor/bin/sail npm install` 
    
This command will use Docker to run npm install within the application's container, ensuring that all Node.js dependencies are installed according to the package.json file located in the application root.

#### 10.  **Compile Front-End Assets**
    
After the installation of Node.js dependencies, you must compile the front-end assets using Laravel Mix. In the same terminal window or tab, execute the following command:
    
`./vendor/bin/sail npm run dev` 
    
This command triggers Laravel Mix to compile and publish the assets, such as CSS and JavaScript files, making them available for use by the application.

#### 11. **(Optional) Run Tests**
    
Ensure that your Docker containers are still up and running. Open a new terminal window or tab and execute the following command:
    
`./vendor/bin/sail php artisan test` 
    
This command will use Laravel's built-in test runner to execute your application's test suite. It will run all the tests located in the tests directory of your application.

By completing this step, you will have fully set up your Truck Management System application on your local development environment, ensuring it is ready for further development, testing, or deployment.

## API Documentation

You can send HTTP requests to the following RESTful endpoints:

1. Get CSRF token :

    `GET /token`
    ```
    HTTP/1.1 200 OK
    Content-Type: text/html; charset=UTF-8

    qyFMrXaSyGee03wjfE2GT1WSyFTBfFMfCrmO64Xk
    ```

2. List trucks
    ```
    GET /trucks
    X-CSRF-TOKEN: {{CSRFTOKEN}}
    ``` 

    ```
    HTTP/1.1 200 OK
    Content-Type: application/json
    
    [
    {
        "id": 28,
        "created_at": "2024-10-03T09:17:28.000000Z",
        "updated_at": "2024-10-03T09:17:28.000000Z",
        "unit_number": "SEED-15637",
        "year": 1998,
        "notes": null
    },
    {
        "id": 29,
        "created_at": "2024-10-03T09:17:28.000000Z",
        "updated_at": "2024-10-03T09:17:28.000000Z",
        "unit_number": "SEED-91917",
        "year": 1998,
        "notes": "Impedit sed sed dolorem mollitia nam velit vel ut."
    },
    ...
    ]
    ```

3. Get truck
    ```
    POST /trucks/{id}
    X-CSRF-TOKEN: {{CSRFTOKEN}}
    ``` 

    ```
    HTTP/1.1 200 OK
    Content-Type: application/json
    
    {
        "id": 28,
        "created_at": "2024-10-03T09:17:28.000000Z",
        "updated_at": "2024-10-03T09:17:28.000000Z",
        "unit_number": "SEED-15637",
        "year": 1998,
        "notes": null
    }
    ```

4. Update truck
    ```
    PUT /trucks/{id}
    X-CSRF-TOKEN: {{CSRFTOKEN}}
    Content-Type: application/json

    {
        "unit_number": "AAAAA",
        "year": 2023,
        "notes": "Brand new truck with advanced features."
    }

    ``` 

    ```
    HTTP/1.1 200 OK
    Content-Type: application/json
    
    {
        "id": 28,
        "created_at": "2024-10-03T09:17:28.000000Z",
        "updated_at": "2024-10-03T09:22:05.000000Z",
        "unit_number": "AAAAA",
        "year": 2023,
        "notes": "Brand new truck with advanced features."
    }
    ```

5. Create truck
    ```
    POST /trucks
    X-CSRF-TOKEN: {{CSRFTOKEN}}
    Content-Type: application/json

    {
        "unit_number": "A1578",
        "year": "2023",
        "notes": ""
    }

    ``` 

    ```
    HTTP/1.1 201 Created
    Content-Type: application/json
    
    {
        "unit_number": "A1578",
        "year": "2023",
        "notes": null,
        "updated_at": "2024-10-03T09:23:13.000000Z",
        "created_at": "2024-10-03T09:23:13.000000Z",
        "id": 31
    }
    ```

6. Delete truck
    ```
    DELETE /trucks/{id}
    X-CSRF-TOKEN: {{CSRFTOKEN}}
    ``` 

    ```
    HTTP/1.1 204 No Content   
    ```

7. Create Subunit
    ```
    POST /subunits
    X-CSRF-TOKEN: {{CSRFTOKEN}}
    Content-Type: application/json

    {
        "main_truck_id": 28,
        "subunit_truck_id": 29,
        "start_date": "2023-04-01",
        "end_date": "2023-04-10"
    }
    ``` 

    ```
    HTTP/1.1 201 Created
    Content-Type: application/json
    
    {
        "main_truck_id": 28,
        "subunit_truck_id": 29,
        "start_date": "2023-04-01",
        "end_date": "2023-04-10",
        "updated_at": "2024-10-03T09:27:50.000000Z",
        "created_at": "2024-10-03T09:27:50.000000Z",
        "id": 5
    }
    ```

## Pages documentation

### Truck crud
![image](https://github.com/user-attachments/assets/c4567610-d531-4911-b301-7147cf0a530a)

### Successful truck creation
![image](https://github.com/user-attachments/assets/15532cfc-dd36-4b7e-b0f5-3d0d7c01b77e)

### Truck creation error
![image](https://github.com/user-attachments/assets/3dd0cdf1-e07e-47e3-94c9-f26b2ef9ebfe)

### Truck edit modal
![image](https://github.com/user-attachments/assets/0fc3661c-b52b-45e6-9da7-9ebaf92e8024)

### Unsuccessful truck edit
![image](https://github.com/user-attachments/assets/2de47145-5177-4557-87a3-25322c0ad4a3)

### Subunit assignment form
![image](https://github.com/user-attachments/assets/887d1613-13c3-4a02-b5ba-65855984e324)

### Successful subunit assignment
![image](https://github.com/user-attachments/assets/5627708c-018a-49c1-a268-bf7b341e87bf)

### Unsuccessful subunit assignment
![image](https://github.com/user-attachments/assets/0ca92cff-f44e-4433-a05a-395da4f01119)

## Entity Relationship Diagram
![erdiagram](https://github.com/user-attachments/assets/19672550-c6ab-4f9b-bd92-10a27f8b1198)

## License

This project is licensed under the MIT License
