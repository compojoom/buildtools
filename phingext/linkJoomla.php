<?php
/**
 * @package    Buildtools
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       02.11.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

require_once 'linkSource.php';
require_once __DIR__ . '/../helpers/symlinker.php';
require_once __DIR__ . '/../helpers/copy.php';
require_once __DIR__ . '/../helpers/language.php';

/**
 * Class LinkJoomla
 *
 * This class symlinks the extension source files to your joomla installation.
 * Usage:
 * <code>
 *  <linkJoomla source="${source}" target="${target}" />
 * </code>
 *
 * @since  1.0
 */
class LinkJoomla extends LinkSource
{
	/**
	 * Main entry point for task
	 *
	 * @return bool
	 */
	public function main()
	{
		$source = $this->getSource();
		$target = $this->getTarget();

		require_once __DIR__ . '/../data/joomla.php';

		// Create the necessary folders
		foreach ($createFolder as $folder)
		{
			if (!file_exists($target . $folder))
			{
				mkdir($target . $folder, 0777, true);
			}
		}

		// Now go through the folders that need symlinking
		foreach ($symLinks as $link)
		{
			if (file_exists($source . $link))
			{
				$it = new BuildHelperSymlinker($source . $link, $target . $link);

				while ($it->valid())
				{
					$it->next();
				}
			}
		}

		// Copy the necessary files
		foreach ($copyFiles as $file)
		{
			copy($source . $file, $target . $file);
		}

		// Copy the installation dir to the new location
		BuildHelperCopy::directory($source . '/installation', $target . '/installation');

		// Create empty directories for known languages
		BuildHelperLanguage::createEmptyLangFoders($target);

		return true;
	}
}
