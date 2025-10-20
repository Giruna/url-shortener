#!/bin/bash
cp .env.example .env
./artisan key:generate
./artisan migrate
./artisan make:filament-user --name=admin --email=admin@localhost --password=abcd1234
./artisan serve
