# Prerequisites
### 1. Install Laragon

### 2. Install Composer

### 3. Create database "travels"

### 4. Remove ".example" from file ".env.example"

# Installation
### 1. run "composer install"

### 2. run "php artisan migrate --seed"

### 3. run "php artisan passport:install"

### 4. run "php artisan key:generate"

### 5. run "npm install"

### 6. Start services in Laragon

# Verify installation
### In postman: get "http://{project folder name}.test/api/trips"

## In browser:
### http://{project folder name}.test

## NOTE
### Login/Register via Facebook and Google will not work without Client ID & Client Secret