# Wordpress Plugin
> Mashery Developer Portal integration plugin for Wordpress.

Plugin for integrating Mashery Developer Portal features into a Wordpress-managed site.

## Setup

Originally we were bundling installation recipes but these have been removed in favor of keeping this repo strictly about the plugin. There are several ways to run a Docker service and these vary depending on your platform. On MAC, you can use boot2docker. I have my own, preferred setup which you can clone [here](https://github.com/lgomez/docker-service).

0. Ensure you have an instance of Wordpress installed locally or on some server where you have permissions to install plugins.
0. Clone this repository and ensure you install the contents into a folder under the wp-content/plugins directory.
0. Go to the admin section of your Wordpress installation. you should see the plugin in the plugins list. Activate it.

You should now be ready to develop and use the plugin.

## Usage

The plugin provides a set of shortcodes that can be used in any post or page within a Wordpress installation. To use them, simply add them inline while editing content. The available shortcodes are:

* `[mashery:profile]`: inserts the user's profile form.
* `[mashery:applications]`: inserts the user's applications list.
* `[mashery:keys]`: inserts the user's key list.
* `[mashery:iodocs]`: inserts an iodocs instance.

## File Summary

* `templates/*` contains the templates used by each shortcode.
* `CONTRIBUTING.md` contains instructions for contributors.
* `main.php` the main entrypoint for the plugin.
* `README.md` this file.

The main file you should be looking at is [main.php](main.php). From there, you should be able to infer what's going on. Open an issue at https://github.com/mashery/wordpress-plugin/issues if you have any questions.

## Containerized (optional)

If you'd like to run this plugin in a Docker container, here's one simple way to run it. Setting up Docker is beyond the scope of this plugin. Please visit [Docker](http://docker.com) for setup instructions and more info.

    docker run -p 8080:80 --name wordpress -v $(pwd):/var/www/html/wp-content/plugins/mashery -e WP_URL=172.17.8.150:8080 -d kaihofstetter/wordpress-cli

Note that `8080` and `172.17.8.150:8080` may vary (likely) depending on your Docker setup.

## Contributing

See [CONTRIBUTING](CONTRIBUTING.md) for details on submitting patches and the contribution workflow.

## Authors

See [AUTHORS](AUTHORS) for details on who's contributing. Feel free to add your name when submitting PRs.

## License

See [LICENSE](LICENSE).

## Useful Links

* https://codex.wordpress.org/Creating_Admin_Themes
* https://codex.wordpress.org/Must_Use_Plugins
* https://codex.wordpress.org/Writing_a_Plugin
