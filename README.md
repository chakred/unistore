## Running
Laravel + Vue.js + Vite + Docker
### commands:
- **make build-end-run**
- **make exac-app**
- - **composer install**
- - **php artisan key:generate**
- - **php artisan migrate**
- - **php artisan db:seed**
- - **php artisan module:seed**
- - **exit**
- **npm run dev**

## Module structure

It includes the pack. nWidart/laravel-modules

- [ref. to gitlab](https://github.com/nWidart/laravel-modules).
- [ref. to doc](https://nwidart.com/laravel-modules/v6/advanced-tools/artisan-commands).


### commands:

- **php artisan module:make ModuleName**
- **php artisan module:seed ModuleName**
- **php artisan module:migrate ModuleName**
- **php artisan module:make-seed seed_fake_module_name ModuleName**
- **php artisan module:make-model ModuleName ModelName**
- **php artisan module:make-migration create_fake_module_table ModuleNme**
