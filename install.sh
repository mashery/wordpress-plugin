echo "Starting installation of $npm_package_fullname"
echo "====================================================="
echo "Provisioning CoreOS VM..."
echo ""
echo "Note: If you get an error mounting NFS volumes, try the following:"
echo ""
echo "      sudo vim /etc/exports"
echo "      # delete the lines for this VM and then..."
echo "      sudo nfsd restart"
echo "      # See: https://github.com/Integralist/Docker-Examples#work-around"
echo ""
# echo $npm_package_name
# echo $npm_package_version
npm_package_fullname=$npm_package_name-$npm_package_version
echo "Using $npm_package_fullname as the container name."
# echo $npm_package_port
# echo $npm_package_ip
npm_package_host=$npm_package_ip:$npm_package_port
echo "Using http://$npm_package_host as host."
# echo $(pwd)
echo "Attempting to stop and remove any previous instances of $npm_package_fullname"
docker stop $npm_package_fullname > /dev/null 2>&1
docker rm $npm_package_fullname > /dev/null 2>&1
echo "Executing run command..."
CID=$(docker run -p $npm_package_port:80 --name $npm_package_fullname -v $(pwd):/var/www/html/wp-content/plugins/mashery -e WP_URL=$npm_package_host -d kaihofstetter/wordpress-cli)
echo "Container ID: $CID"
echo "Waiting for mysql to start. This may take a minute..."
sleep 10
WP_PATH='/var/www/html/'
echo "Starting bootstrap process."
echo "Deleting sample posts..."
docker exec -i -t $npm_package_fullname wp post delete $(docker exec -i -t $npm_package_fullname wp post list --format=ids --allow-root --path=$WP_PATH) --allow-root --path=$WP_PATH
echo "Deleting sample pages..."
docker exec -i -t $npm_package_fullname wp post delete $(docker exec -i -t $npm_package_fullname wp post list --post_type=page --format=ids --allow-root --path=$WP_PATH) --allow-root --path=$WP_PATH
echo "Creating page with sample shortcodes..."
docker exec -i -t $npm_package_fullname wp post create \
    --post_type=page \
    --post_content="[mashery:applications]<br>[mashery:keys]<br>[mashery:documentation]<br>[mashery:iodocs]<br>[mashery:profile]" \
    --post_title='Home' \
    --post_id=home \
    --post_status=publish \
    --allow-root \
    --path=$WP_PATH
echo "Setting page as home page..."
docker exec -i -t $npm_package_fullname wp option update show_on_front 'page' --allow-root --path=$WP_PATH
HOME=$(docker exec -i -t $npm_package_fullname wp post list --allow-root --path=$WP_PATH --post_type=page --pagename=home --field=ID --format=ids)
docker exec -i -t $npm_package_fullname wp option update page_on_front $HOME --allow-root --path=$WP_PATH
echo "Deleting default plugins..."
docker exec -i -t $npm_package_fullname wp plugin delete hello akismet --allow-root --path=$WP_PATH
echo "Deleting sample widgets..."
docker exec -i -t $npm_package_fullname wp widget delete search-2 recent-posts-2 recent-comments-2 archives-2 categories-2 meta-2 --allow-root --path=$WP_PATH
echo "Activating Mashery plugin..."
docker exec -i -t $npm_package_fullname wp plugin activate mashery --allow-root --path=$WP_PATH
echo ""
docker ps --filter="name=$npm_package_fullname"
echo ""
echo "Installation is now complete."
echo "====================================================="
echo ""
echo "  $npm_package_fullname is now running and reachable at http://$npm_package_host"
echo "  To stop run \"npm stop\"."
echo "  To start run \"npm start\"."
echo "  To uninstall run \"npm uninstall\"."
echo ""
echo "  Access the Wordpress admin at: http://$npm_package_host/wp-admin/"
echo "     User: admin_user"
echo "     Password: secret"
echo ""
echo "====================================================="
echo ""

############# REFERENCE

# ssh-add ~/.vagrant.d/insecure_private_key
# vagrant ssh core-01 -- -A
# fleetctl list-machines
# etcdctl set first-etcd-key "Hello World"
# fleetctl ssh cb35b356 etcdctl get first-etcd-key
#
# # Export the DOCKER_HOST to the right address.
# # export DOCKER_HOST=tcp://localhost:2375
# export DOCKER_HOST=tcp://172.17.8.150:2375
#
# # Clean slate
# docker stop $(docker ps -a -q)
# docker rm $(docker ps -a -q)
# docker rmi $(docker images -a -q)
# docker ps -a
# docker images -a
#
# # Check
# docker ps -a
# docker images -a
#
# # DATA CONTAINER
# DB=$(docker run -d -t --name db -e "MYSQL_ROOT_PASSWORD=example" mariadb)
# echo $DB
# docker exec -it $DB /bin/sh
# docker stop $DB
# docker rm $DB
#
# # DATA CONTAINER
# WP=$(docker build .)
# WP=$(docker run -d -t -p 8080:80 --link db:mysql -v $(pwd):/var/www/html/wp-content/plugins/mashery wordpress)
# docker exec -it $WP /bin/sh
# docker start $WP
# docker stop $WP
# docker rm $WP
#
#
# docker run --name wordpress -p 8080:80 -v $(pwd):/var/www/html/wp-content/plugins/mashery -e WP_URL="172.17.8.150:8080" -d kaihofstetter/wordpress-cli
# WP_PATH='/var/www/html/'
# docker exec -i -t wordpress wp post delete $(docker exec -i -t wordpress wp post list --format=ids --allow-root --path=$WP_PATH) --allow-root --path=$WP_PATH
# docker exec -i -t wordpress wp post delete $(docker exec -i -t wordpress wp post list --post_type=page --format=ids --allow-root --path=$WP_PATH) --allow-root --path=$WP_PATH
# docker exec -i -t wordpress wp post create \
#     --post_type=page \
#     --post_content="[mashery:applications]<br>[mashery:keys]<br>[mashery:documentation]<br>[mashery:iodocs]<br>[mashery:profile]" \
#     --post_title='Home' \
#     --post_id=home \
#     --post_status=publish \
#     --allow-root \
#     --path=$WP_PATH
# docker exec -i -t wordpress wp option update show_on_front 'page' --allow-root --path=$WP_PATH
# HOME=$(docker exec -i -t wordpress wp post list --allow-root --path=$WP_PATH --post_type=page --pagename=home --field=ID --format=ids)
# docker exec -i -t wordpress wp option update page_on_front $HOME --allow-root --path=$WP_PATH
# docker exec -i -t wordpress wp plugin delete hello akismet --allow-root --path=$WP_PATH
# docker exec -i -t wordpress wp widget delete search-2 recent-posts-2 recent-comments-2 archives-2 categories-2 meta-2 --allow-root --path=$WP_PATH
# docker exec -i -t wordpress wp plugin activate mashery --allow-root --path=$WP_PATH
#
#
# # PENDING
#
# # Fix mounting of /Users on CoreOS
# # https://github.com/Integralist/Docker-Examples#work-around
# sudo vim /etc/exports
# sudo nfsd restart
#
# # wordpress:
# #   image: wordpress
# #   volumes:
# #     - /shared:/var/www/html/wp-content/plugins/mashery
# #   links:
# #     - db:mysql
# #   ports:
# #     - 8080:80
# #
# # db:
# #   image: mariadb
# #   # volumes:
# #   #   - ./data:/var/lib/mysql
# #   environment:
# #     MYSQL_ROOT_PASSWORD: example
# #     # MYSQL_ROOT_PASSWORD: mashery
