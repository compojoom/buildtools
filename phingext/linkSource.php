<?php
/**
 * @package    Buildtools
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       02.11.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

require_once 'phing/Task.php';
require_once __DIR__ . '/../helpers/symlinker.php';

/**
 * Class LinkSource
 *
 * This class symlinks the extension source files to your joomla installation.
 * Usage:
 * <code>
 *  <linkSource source="${source}" target="${target}" />
 * </code>
 *
 * @since  1.0
 */
class LinkSource extends Task
{
	/**
	 * Set the target location
	 *
	 * @param   string  $target  - path to the target
	 *
	 * @return void
	 */
	public function setTarget($target)
	{
		$this->_target = $target;
	}

	/**
	 * Gets the target path
	 *
	 * @return string
	 */
	public function getTarget()
	{
		return $this->_target;
	}

	/**
	 * Sets the source location
	 *
	 * @param   string  $source  - path to the source files
	 *
	 * @return void
	 */
	public function setSource($source)
	{
		$this->_source = $source;
	}

	/**
	 * Gets the source path
	 *
	 * @return mixed
	 */
	public function getSource()
	{
		return $this->_source;
	}

	/**
	 * Main entry point for task
	 *
	 * @return bool
	 */
	public function main()
	{
		// Set repository root path
		$source = $this->getSource();
		$target = $this->getTarget();


		$file = $source . '/../builds/templates/symlinks.php';

		// If we have custom symlink paths, let us symlink them first
		if (file_exists($file))
		{
			require_once $file;

			foreach ($symlinks as $key => $value)
			{
				if (!file_exists($source . $value))
				{
					mkdir($source . $value, 0755, true);
				}

				$sym = new BuildHelperSymlinker($source . $key, $source . $value, 'link');

				while ($sym->valid())
				{
					$sym->next();
				}
			}
		}

		$it = new BuildHelperSymlinker($source, $target);

		while ($it->valid())
		{
			$it->next();
		}



		return true;
	}
}
