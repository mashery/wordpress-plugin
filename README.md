```
docker build --rm -t mashery/wordpress .
```
```
docker run --name wordpress -d -p 8080:80 \
    -v /Users/lgomez/Projects/mashery/wordpress-development/integration:/var/www/wp-content/plugins/mashery-integration \
    -v /Users/lgomez/Projects/mashery/wordpress-development/admin:/var/www/wp-content/plugins/mashery-admin \
    -v /Users/lgomez/Projects/mashery/wordpress-development/theme:/var/www/wp-content/themes/mashery \
     -t mashery/wordpress
```
```
docker exec -i -t wordpress bash
```
