


# Локальное развертывание

### 1) Установить Docker (Для windows также установить WSL2)
Windows: запускаем Docker Desktop. Запускаем wsl2 и выполняем команды.  
Linux: сразу выполняем команды в терминале

### 2) Устанавливаем дополнительное ПО:

* PHP 8.2
* composer 2
* nodeJS 18
* npm
* зависимости php:

    - php8.2-xml
    - php8.2-curl
    - php8.2-intl
    - php8.2-mbstring

### 3) Клонируем проект

```
git clone NAME .
```

### 4) Устанавливаем зависимости

```
composer install
npm install
```

### 5) Создаём .env файл

```
cp .env.example .env
```

### 6) Заполняем .ENV файл

- DB_CONNECTION=mysql
- DB_HOST=mysql
- DB_PORT=3306
- DB_DATABASE=excelparser
- DB_USERNAME=sail
- DB_PASSWORD=password
- BROADCAST_DRIVER=redis
- QUEUE_CONNECTION=database

### 7) Генерируем ключ приложения
```
php artisan key:generate
```

### 8) Очищаем кеш
```
php artisan optimize:clear
```

### 9) Запускаем контейнер
```
./vendor/bin/sail up
```

### 10) Выполняем миграции
```
./vendor/bin/sail artisan migrate
```
### 11) Заполняем базу начальными данными
```
./vendor/bin/sail artisan db:seed --class=UserSeeder
```
### 12) Собираем Frontend
```
npm run build
или
npm run dev
```
### 13) Тесты
```
./vendor/bin/sail phpunit
```
### 14) Очереди
```
./vendor/bin/sail php artisan queue:listen --queue=high,default
или настройка через supervisor
```

WebServer: localhost  
PhpMyAdmin: localhost:8080

Начальные данные для входа:  
login: admin@example.com  
password: admin

Для работы BroadCast нужен laravel-echo-server
```
npm install laravel-echo-server
laravel-echo-server init
laravel-echo-server start
```

# Развертывание на сервере

### 1) Подключаемся к серверу и переходим в директорию проекта
### 2) Аналогично выполняем пункты 2-5, описанные выше
### 3) Также устанавливаем

- WebServer (Apache или Nginx)
- MySql
- PhpMyAdmin (По желанию)
- Redis

### 4) Заполняем .ENV файл вашими данными

- APP_URL=
- LOG_LEVEL=error
- DB_CONNECTION=mysql
- DB_HOST=mysql
- DB_PORT=3306
- DB_DATABASE=
- DB_USERNAME=
- DB_PASSWORD=
- BROADCAST_DRIVER=redis
- QUEUE_CONNECTION=database

### 5) Генерируем ключ приложения
```
php artisan key:generate
```
### 6) Очищаем кеш
```
php artisan optimize:clear
```
### 7) Выполняем миграции
```
php artisan migrate
```
### 8) Меняем начальные данные в файлах:
```
database/seeders/UserSeeder.php
```
- name
- email
- password

### 9) Заполняем базу начальными данными
```
php artisan db:seed --class=UserSeeder
```

### 10) Собираем Frontend
```
npm run build
```

### 11) Тесты
```
./vendor/bin/sail phpunit
```

### 12) Очереди
```
./vendor/bin/sail php artisan queue:listen --queue=high,default
или настройка через supervisor
```
