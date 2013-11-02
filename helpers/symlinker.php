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
 * @version     $Id: symlinker-win.php 36 2011-03-10 22:56:21Z torkiljohnsen $
 * @package     NookuSymlinker
 * @copyright   Copyright (C) 2007 - 2010 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license     GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link        http://www.koowa.org
 *
 * Windows port by Ercan Özkaya
 */

define('IS_WINDOWS', substr(PHP_OS, 0, 3) == 'WIN');

/**
 * Class BuildHelperSymlinker
 *
 * @since  1.0
 */
class BuildHelperSymlinker extends RecursiveIteratorIterator
{
	/**
	 * @var Traversable
	 */
	protected $_srcdir;

	/**
	 * @var
	 */
	protected $_tgtdir;

	/**
	 * The constructor
	 *
	 * @param   Traversable  $srcdir  - the source directory
	 * @param   string       $tgtdir  - the target directory
	 */
	public function __construct($srcdir, $tgtdir)
	{
		$this->_srcdir = $srcdir;
		$this->_tgtdir = $tgtdir;

		parent::__construct(new RecursiveDirectoryIterator($this->_srcdir));
	}

	/**
	 * Has children
	 *
	 * @return bool
	 */
	public function callHasChildren()
	{
		$filename = $this->getFilename();

		if ($filename[0] == '.')
		{
			return false;
		}

		$src = $this->key();

		$tgt = str_replace($this->_srcdir, '', $src);
		$tgt = str_replace('\site', '', $tgt);
		$tgt = $this->_tgtdir . $tgt;

		if (is_link($tgt))
		{
			if (is_file($tgt))
			{
				unlink($tgt);
			}
		}

		if (!is_dir($tgt))
		{
			$this->createLink($src, $tgt);

			return false;
		}

		return parent::callHasChildren();
	}

	/**
	 * Creates the symlink for the file
	 *
	 * @param   string  $src  - the source path to the file
	 * @param   string  $tgt  - the target path to the file
	 *
	 * @return void
	 */
	public function createLink($src, $tgt)
	{
		if (!file_exists($tgt))
		{
			if (IS_WINDOWS)
			{
				$opts = '';

				if (is_dir($src))
				{
					$opts = '/D';
				}

				$cmd = "mklink $opts \"$tgt\" \"$src\"";
				$result = exec($cmd);
				echo ($result == '' ? 'ERROR: ' : '') . "$src\n\t--> $tgt\n";
			}
			else
			{
				exec("ln -sf $src $tgt");

				echo $src . PHP_EOL . "\t--> $tgt" . PHP_EOL;
			}
		}

	}
}
