# PHP test project

---

This project is a demonstration of generic pagination service using minimal symfony 7.4 application.

## Project setup

### Requirements 
- PHP 8.2 & composer for local development, or
- Docker & docker-compose for containerized development

### Installation
1. Clone the repository: `git clone https://github.com/lukaskupka/php-test.git`
2. Navigate to the project directory: `cd php-test`
3. Set up `default_page_size`, `mobile_page_size` and `fake_item_count` parameters in `config/services.yaml`
4. Install dependencies: `composer install`
5. Run codesniffer: `composer lint:php`
6. Run static analysis: `composer phpstan`
7. Run unit tests: `composer test`

### Container setup
1. Navigate to docker directory: `cd docker`
2. Build the Docker image: `docker-compose -f docker-compose.yml build`
3. Start the Docker containers: `docker-compose -f docker-compose.yml up -d`
4. Add `php-test.local` to your `/etc/hosts` file
5. Access the application: `http://php-test.local`
