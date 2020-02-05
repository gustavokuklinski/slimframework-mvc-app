<?php

/*
 * autoload Slim Framrwork and lib from vendor folder
 */
require '../vendor/autoload.php';

/*
 * get basic settings for the framework
 */
require 'config/settings.php';

/*
 * boot the framework
 */
require 'core/bootstrap.php';

/*
 * generate the container for database connection and template
 */
require 'config/container.php';

/*
 * all your app will be running here. All setup to create:
 * - controllers
 * - models
 * - views
 */
require 'config/routes.php';

/*
 * startup the app
 */
require 'core/startup.php';
