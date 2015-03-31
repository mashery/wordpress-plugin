# Mashery Developer Portal & CMS
> Proof of Concept powered by Wordpress and Mashery Platform APIs.

The point of this project is to test wether it is possible and the
level of difficulty of adopting Wordpress to replace Mashery's current
Developmer Portal and CMS solutions while at the same time satisfying
the documented needs Mashery has in these areas. In particular, the
need to reduce support requests and improve sales and retention.

A separate analysis has already taken place to produce a list of
requirements that would satisfy the needs normally addressed by a
modern and competitive Portal and CMS solution. One of the possible
solutions to our current problem may be adopting an existing content
management system like Wordpress.

## Goal

This project aims to proove that Wordpress can satisfy our needs and
tests that:

1. Integration to Control Center can be seamless:
    1. Theme is reasonably close to Control Center's.
    2. No need for double-authentication (ie: Shared realm).
2. Feature parity with current portal solution. In particular:
    1. Self-service registration and account management.
    2. Self-service key provisioning and management.

Other features such as wether the CMS functionality is covered, wether
theeming is supported, popular third-party integrations, etc. are all
known to be provided by Wordpress and we may not attempt to cover those
here.

## Run Locally

This project runs the latest version of Wordpress within a Docker
container to simplify development so you must have an environment setup
that supports this. If you know what you are doing and/or already have
local support for docker containers and the docker client, feel free to
skip the *Environment Setup* section.

### Environment Setup

The simplest and fastest way to set your sistem up for this is to use
Brew and Cask to install VirtualBox, Vagrant and boot2docker. Here's
a set of commands to get that done.

    ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
    brew install caskroom/cask/brew-cask
    brew cask install node
    brew cask install virtualbox
    brew cask install vagrant
    brew cask install boot2docker
    boot2docker up

You should now have everything you need to go to the next section.

### Project Setup

    git clone git@github.com:lgomez/mashery-developer-portal.git
    cd mashery-developer-portal

### Usage & Commands

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

### Contributing

Contributions will only be accepted via pull requests. Please fork, do your thing and PR me.

### Basic Structure

The main file you should be looking at is main.php. Easy enough. From there, you shuold be able to infer what's going on. If not yet, soon enough.

### Useful Links

* https://codex.wordpress.org/Creating_Admin_Themes
* https://codex.wordpress.org/Must_Use_Plugins
* https://codex.wordpress.org/Writing_a_Plugin
