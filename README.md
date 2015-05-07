# Mashery Developer Portal & CMS
> Proof of Concept powered by Wordpress and Mashery Platform APIs.

Is Wordpress a viable option to replace Mashery's current Developer Portal & CMS product? Read the original dicsussion [here](https://mashery.jira.com/wiki/pages/viewpage.action?pageId=99844396) (requires Jira access). See progress [here](../../milestones).

## Setup

This is a PHP project but, to make things easier, we are running things in a [Docker](https://www.docker.com/) container. To get started, build, run, etc. You'll need:

0. Install [VirtualBox](https://www.virtualbox.org/)
0. Install [Vagrant](https://www.vagrantup.com/)
0. Install the `docker` Client. I recommend you use `brew install docker` for this or go to the Docker site for instructions.
0. `git clone git@github.com:mashery/wordpress-plugin.git`
0. `cd <your local clone>`

## Usage & Commands

* Start the environment: `vagrant up` (only required once - this will take a few minutes)
* `export DOCKER_HOST=tcp://172.17.8.150:2375` to ensure `docker` points to the correct daemon. Note the IP can be changed in the vagrantfile.
* Build and run the containers: `docker-compose up` (only required once - this will take a few minutes)
* `docker-compose ps` to see the running containers.
* `docker-compose stop` to stop the running containers.
* `docker-compose kill` to kill the running containers.
* `vagrant ssh` to ssh into the VM.
* `docker exec -it <container id> /bin/bash` to go into the running container.
* `vagrant suspend` to suspend the VM. You should do this if you are not working on this to save resources. Also, try using this instead of `vagrant destroy` or else you'll have to go through the wordpress admin setup and you will have lost your data.
* `vagrant destroy` to destroy the VM.

Once you are up and running, you should be able to go to http://172.17.8.150:8080/ and see the page. Note that the first time you will be taken through the wordpress setup wizard.

## Contributing

See [CONTRIBUTING](CONTRIBUTING.md) for details on submitting patches and the contribution workflow.

## Basic Structure

The main file you should be looking at is [main.php](main.php). Easy enough. From there, you should be able to infer what's going on. Open an issue at https://github.com/mashery/wordpress-plugin/issues if you have any questions.

## Useful Links

* https://codex.wordpress.org/Creating_Admin_Themes
* https://codex.wordpress.org/Must_Use_Plugins
* https://codex.wordpress.org/Writing_a_Plugin
