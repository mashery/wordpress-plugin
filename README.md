# Mashery's New Developer Portal & CMS
> Proof of Concept powered by Wordpress and The Mashery Platform API

This project aims to integrate the latest version of Wordpress with Mashery's API
Management Service. It is composed of three parts:

* Admin Integration Plugin
* Portal Integration Plugin
* Default Developer Portal Theme

## Run Locally

To run locally you'll need to be able to run Docker containers.
On OSX you can get that done quickly by following these steps:

* Install `boot2docker` See: http://docs.docker.com/installation/mac/
* Clone this repo: `git clone git@github.com:lgomez/wordpress-development.git`
* Change directory: `cd wordpress-development`
* Build the image: `docker build --rm -t mashery/wordpress .`
* Run the container:

```Shell
docker run \
    --name wordpress -d \
    -p 8080:80 \
    -v $PWD/integration:/var/www/wp-content/plugins/mashery-integration \
    -v $PWD/admin:/var/www/wp-content/plugins/mashery-admin \
    -v $PWD/theme:/var/www/wp-content/themes/mashery \
    -t mashery/wordpress
```
Note that you can change the port above (`8080`) to whatever you'd like.

## SSH Into The Container
```
docker exec -i -t wordpress bash
```

## Stop The Container
```
docker stop wordpress
```
