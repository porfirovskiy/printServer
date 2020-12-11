
Test project.

How to use local:

1. Move to project root directory(one level with vendor and src dir)
2. Start php server:
```sh
php -S localhost:8000 -t public/
```
3. For add your messages on server, make GET request.
Example:
```js
http://localhost:8000/printMeAt?time=2020-12-11 120:35:00&message=new message 32
```
4. Launch worker:
```sh
php src/Worker/worker.php
```
5. Play with some test messages and see result in console where worker launched


