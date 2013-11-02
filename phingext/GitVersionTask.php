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
 * Git latest tree version to Phing property
 * @package    akeebabuilder
 * @copyright  Copyright (c)2009-2010 Nicholas K. Dionysopoulos
 * @license    GNU GPL version 3 or, at your option, any later version
 * @author     nicholas
 */

require_once 'phing/Task.php';
require_once 'phing/tasks/ext/svn/SvnBaseTask.php';

/**
 * Class GitVersionTask
 *
 * @since  1.0
 */
class GitVersionTask extends SvnBaseTask
{
	private $propertyName = "git.version";

	/**
	 * Sets the name of the property to use
	 *
	 * @param   string  $propertyName  - the property name
	 *
	 * @return void
	 */
	public function setPropertyName($propertyName)
	{
		$this->propertyName = $propertyName;
	}

	/**
	 * Returns the name of the property to use
	 *
	 * @return string
	 */
	public function getPropertyName()
	{
		return $this->propertyName;
	}

	/**
	 * Sets the path to the working copy
	 *
	 * @param   string  $wc  - working copy path
	 *
	 * @return void
	 */
	public function setWorkingCopy($wc)
	{
		$this->workingCopy = $wc;
	}

	/**
	 * The main entry point
	 *
	 * @throws BuildException
	 *
	 * @return void
	 */
	public function main()
	{
		$this->setup('info');


		exec('git log -n 1 --no-decorate --pretty=format:"%h" ' . escapeshellarg(realpath($this->workingCopy)), $out);
		$version = $out[0];

		$this->project->setProperty($this->getPropertyName(), $version);
	}
}
