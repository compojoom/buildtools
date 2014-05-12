<?php
/**
 * @package    Buildtools
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       02.11.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

// The directories we need to create for our joomla installation
$createFolder = array(
	'\administrator\components',
	'\administrator\help',
	'\administrator\includes',
	'\administrator\language\en-GB',
	'\administrator\language\overrides',
	'\administrator\manifests',
	'\administrator\modules',
	'\administrator\templates',
	'\cli',
	'\components',
	'\images',
	'\includes',
	'\language\en-GB',
	'\language\overrides',
	'\layouts',
	'\libraries',
	'\media',
	'\modules',
	'\plugins\authentication',
	'\plugins\captcha',
	'\plugins\content',
	'\plugins\editors',
	'\plugins\editors-xtd',
	'\plugins\extension',
	'\plugins\finder',
	'\plugins\quickicon',
	'\plugins\search',
	'\plugins\system',
	'\plugins\twofactorauth',
	'\plugins\user',
	'\templates',
);

// The symlinks that we need to create
$symLinks = array(
	'\administrator\components',
	'\administrator\help',
	'\administrator\includes',
	'\administrator\language\en-GB',
	'\administrator\language\overrides',
	'\administrator\manifests',
	'\administrator\modules',
	'\administrator\templates',
	'\components',
	'\cli',
	'\images',
	'\includes',
	'\language\en-GB',
	'\language\overrides',
	'\layouts',
	'\libraries',
	'\media',
	'\modules',
	'\plugins\authentication',
	'\plugins\content',
	'\plugins\captcha',
	'\plugins\editors',
	'\plugins\editors-xtd',
	'\plugins\extension',
	'\plugins\finder',
	'\plugins\quickicon',
	'\plugins\search',
	'\plugins\system',
	'\plugins\twofactorauth',
	'\plugins\user',
	'\templates',
);

// Files to copy
$copyFiles = array(
	'/htaccess.txt',
	'/index.php',
	'/joomla.xml',
	'/LICENSE.txt',
	'/README.txt',
	'/robots.txt.dist',
	'/web.config.txt',
	'/administrator/index.php'
);