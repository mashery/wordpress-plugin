# Mashery Developer Portal & CMS
> Proof of Concept powered by Wordpress and Mashery Platform APIs.

Is Wordpress a viable option to replace Mashery's current Developer Portal & CMS product? Read the original dicsussion [here](https://mashery.jira.com/wiki/pages/viewpage.action?pageId=99844396) (requires Jira access). See progress [here](../../milestones).

## Questions

1. Is it technically possible? See [requirements](../../issues?utf8=✓&q=label%3Arequirement).
2. How long would it take? See [milestones](../../milestones).
3. What are the blockers? See [blockers](../../issues?utf8=✓&q=label%3Aplatform+label%3Ablocker).

## Local Setup

This is a PHP project but, to make things easier, we are running things in a [Docker](https://www.docker.com/) container and using Node's NPM tool to manage a number of commands/scripts you'll use to get started, build, run, etc. You'll need:

1. [Node.js](https://nodejs.org/)
2. [VirtualBox](https://www.virtualbox.org/)
3. [Vagrant](https://www.vagrantup.com/)
4. [Boot2Docker](http://boot2docker.io/)

You may already heve these installed. If not, here's a suggested set of steps you can use to set up your system. If you don't know what you are doing or what these mean, you should probably not just run these blindly.

    ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
    brew install caskroom/cask/brew-cask
    brew cask install node
    brew cask install virtualbox
    brew cask install vagrant
    brew cask install boot2docker
    boot2docker up

You should now have everything you need to set up the project.

## Project Setup

    git clone git@github.com:lgomez/mashery-developer-portal.git
    cd mashery-developer-portal

## Usage & Commands

There are several `npm` commands that'll make it much simpler for you to build,
run and work with this POC. Please take a look at the `scripts` attribute in `package.json`
to see a full list of what's available.

To quickly get started you can just run:

    npm run build

Which will build a fresh image off of which we'll be basing our container from and then:

    npm start

Which will either restart or create (and start) the container.

    npm run wp:open

Will open your default browser to the address where all this is running at.

## Contributing

Contributions will only be accepted via pull requests. Please fork, do your thing and PR me.

## Basic Structure

The main file you should be looking at is [main.php](main.php). Easy enough. From there, you shuold be able to infer what's going on. If not yet, soon enough.

## Useful Links

* https://codex.wordpress.org/Creating_Admin_Themes
* https://codex.wordpress.org/Must_Use_Plugins
* https://codex.wordpress.org/Writing_a_Plugin
