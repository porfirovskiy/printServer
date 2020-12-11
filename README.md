
Test project with Redis storage.

How to use local:

1. git clone https://github.com/porfirovskiy/printServer.git

2. Move to project root directory(one level with vendor and src dir)

3. composer install

4. Start php server:
```sh
php -S localhost:8000 -t public/
```
5. For add your messages on server, make GET request.
Example:
```js
http://localhost:8000/printMeAt?time=2020-12-11 20:35:00&message=new message 32
```
6. Launch worker:
```sh
php src/Worker/worker.php
```
7. Play with some test messages and see result in console where worker launched


