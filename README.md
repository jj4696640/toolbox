# Toolbox
Toolbox is a web application built using Laravel PHP framework and Vue.js for collecting suspect information. The aim of the project is to provide a platform to manage and store suspect information efficiently.

## Getting Started
To get started with the development of Toolbox, follow the steps below:

1. Clone the repository:
   ```
   git clone https://github.com/[YOUR_GITHUB_USERNAME]/toolbox.git -b develop
   ```
2. Install the dependencies:
    ```
    composer install
    npm install
    ```
3. Set up the environment:
    ```
    cp .env.example .env
    php artisan key:generate
    ```
4. Set up the database:
   
   This project uses MySQL 8 as the preferred database. Create a database and update the .env file with the database credentials.
5. Migrate the database:
   ```
   php artisan migrate
   ```
## Contribution
Contributions to the project are welcome. Follow the steps below to contribute:

1. Clone the repository:
   ```
   git clone https://github.com/[YOUR_GITHUB_USERNAME]/toolbox.git -b develop
   ```
2. Create a new branch with a descriptive name for the changes you want to make:
   ```
   git checkout -b feature/[YOUR_BRANCH_NAME]
   ```
3. Make your changes and commit with a descriptive message:
   ```
   git add .
   git commit -m "Add a detailed commit message"
   ```
4. Push your changes to the repository:
   ```
   git push origin feature/[YOUR_BRANCH_NAME]
   ```
5. Create a pull request to the develop branch with a detailed description of the changes you made and the reasons for making them.
   
## Deployment
The QA site for the project is located at qa.toolbox.co.ug and the production site is located at toolbox.co.ug. The deployment process should be handled by the project maintainers.

### Prerequisites
The following software is required to develop and run Toolbox:

1. PHP 8.1
2. MySQL 8
3. Composer
4. Node.js and npm
## Built With
1. Laravel - The PHP framework used
2. Vue.js - The JavaScript framework used
## License
The project is licensed under the MIT License.
