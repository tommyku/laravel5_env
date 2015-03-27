# Laravel 5 env

An artisan command for managing multiple `.env` of your Laravel 5 app.

# Usage

Save the current `.env` into `.$APP_ENV.env`.

```bash
$ php artisan env
Current application environment: local
$ php artisan env:switch --save
Environmental config file .local.env saved
```

Switch to another environment, given `.$TARGET_ENV.env` exists.

```bash
$ php artisan env
Current application environment: test
$ php artisan env:switch local
Successfully switched from test to local.
$ php artisan env
Current application environment: local
```

## Thank you

* Thanks [@leonel](http://blog.tommyku.com/blog/setting-up-laravel-5-0-for-openshift#comment-1905666612) for raising the issue, which inspired me to create this command.
