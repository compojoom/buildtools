<?php
/**
 * @package    Buildtools
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       02.11.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Class BuildHelperCopy
 *
 * @since  1.0
 */
class BuildHelperCopy
{
	/**
	 * Copy a directory with its contents to the new location
	 *
	 * @param   string  $source       - the source dir to copy
	 * @param   string  $destination  - the target
	 *
	 * @return void
	 */
	public static function directory($source, $destination)
	{
		if (is_dir($source))
		{
			@mkdir($destination);
			$directory = dir($source);

			while (false !== ($readdirectory = $directory->read()))
			{
				if ($readdirectory == '.' || $readdirectory == '..')
				{
					continue;
				}

				$PathDir = $source . '/' . $readdirectory;

				if (is_dir($PathDir))
				{
					self::directory($PathDir, $destination . '/' . $readdirectory);
					continue;
				}

				copy($PathDir, $destination . '/' . $readdirectory);
			}

			$directory->close();
		}
		else
		{
			copy($source, $destination);
		}
	}
}
