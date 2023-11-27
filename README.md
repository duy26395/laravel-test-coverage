

## About
Create PhpUnit Test and Reporting Test Coverage

### install laravel use docker

```shell
sh init.sh
```
### Run test case
```shell
docker exec coverage_php-fpm php artisan test --filter=test_getSchedules
```
### Create Reporting test Coverage

```shell
docker exec coverage_php-fpm php artisan test --coverage-html=coverage
```