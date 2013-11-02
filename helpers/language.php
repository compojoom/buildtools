<?php
/**
 * @package    buildtools
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       02.11.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Class BuildHelperLanguage
 *
 * @since  1.0
 */
class BuildHelperLanguage
{
	/**
	 * We need to create empty language folders. Otherwise the linkSource script will link the whole
	 * language folder, instead of the single languages and our project will get mixed up
	 *
	 * @param   string  $target  - the target path
	 *
	 * @return void
	 */
	public static function createEmptyLangFoders($target)
	{
		$languages = parse_ini_file(__DIR__ . '/../data/langs.ini');

		$paths = array(
			$target . '/administrator/language/',
			$target . '/language/'
		);

		// Let us create  some folders
		foreach ($languages as $key => $language)
		{
			$language = trim($language);

			foreach ($paths as $path)
			{
				if (!file_exists(($path . $language)))
				{
					mkdir($path . $language);
					print $path . $language . "\n";
				}
			}
		}

	}
}
