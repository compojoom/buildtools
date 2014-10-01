<?php
/**
 * @package    Buildtools
 * @author     DanielDimitrov <daniel@compojoom.com>
 * @date       02.11.13
 *
 * @copyright  Copyright (C) 2008 - 2013 compojoom.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

require_once "phing/Task.php";

/**
 * Class ExplodeTask
 *
 * @since  1.0
 */
class ExplodeTask extends Task
{
	/**
	 * Sets the string to explode
	 *
	 * @param   string  $string  - the string
	 *
	 * @return void
	 */
	public function setString($string)
	{
		$this->string = $string;
	}

	/**
	 * Sets the delimniter to use for the explode
	 *
	 * @param   string  $delimiter  - the delimiter
	 *
	 * @return void
	 */
	public function setDelimiter($delimiter)
	{
		$this->delimiter = $delimiter;
	}

	/**
	 * Sets which part of the exploded string to return
	 *
	 * @param   string  $key  - the key
	 *
	 * @return void
	 */
	public function setKey($key)
	{
		$this->key = $key;
	}

	/**
	 * Defines the name of a property to be set .
	 *
	 * @param   string  $name  - Name for the property to be set from input
	 *
	 * @return void
	 */
	public function setPropertyName($name)
	{
		$this->propertyName = $name;
	}

	/**
	 * The init method: Do init steps.
	 *
	 * @return void
	 */
	public function init()
	{
		// Nothing to do here
	}

	/**
	 * The main entry point method.
	 *
	 * @throws BuildException
	 *
	 * @return void
	 */
	public function main()
	{
		if ($this->propertyName === null)
		{
			throw new BuildException("You must specify a value for propertyName attribute.");
		}

		$value = explode($this->delimiter, $this->string);

		if ($value !== null)
		{
			if ($this->key == 'rest')
			{
				if (count($value) > 2)
				{
					// Removes plg
					array_shift($value);

					// Removes plugin type
					array_shift($value);
					$name = implode($this->delimiter, $value);
				}
			}
			else
			{
				$name = $value[$this->key];
			}

			$this->project->setUserProperty($this->propertyName, $name);
		}
	}
}
