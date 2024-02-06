1. Run command `docker compose build` ở terminal
```php
docker compose build
```

2. Trong docker-compose.yml, comment dòng `command: [ "php", "artisan", "octane:start", "--host=0.0.0.0", "--port=1215" ]`
3. Run command 
```php 
docker compose up
```
4. Mở tab terminal khác và run 
```php
docker ps -a
```
5. Tìm dòng rental_house_worker và check 3 ký tự đầu trong cột CONTAINER ID
   VD: `c804e35f8968 - rental_house_worker`
   \*Lưu ý: container id sẽ thay đổi mỗi khi chạy lại `docker compose up`
6. RUN CMD
```php
docker exec -it c80 bash
```
7. Khi đã execute được container.
   Run command
   ```php
    composer update
   ```
   ```php 
    cp .env.example .env
   ```
   ```php
    php artisan key:generate
   ```
   ```php
    artisan octane:install
   ```
   Sau đó chọn option `1: Swoole`
8. Run command
```php
php artisan setup
```
để migrate db và tạo account admin. Tài khoản admin được config trong .env
9. Mở terminal chạy
```php 
docker compose down
```
10. Mở comment ở bước 2.
11. Chạy lại command
```php 
docker compose up
```
12. Mở Browser và chạy `localhost:81`
13. 
```php 
php artisan migrate --path=app/Core/Logging/migrations
```
14. Setup db: Character set: ```utf8mb4```
15. Setup db: Collation: ```utf8mb4_general_ci```