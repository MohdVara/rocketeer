<?php
/*
 * This file is part of Rocketeer
 *
 * (c) Maxime Fabre <ehtnam6@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Rocketeer\Strategies\Dependencies;

use Rocketeer\Abstracts\Strategies\AbstractDependenciesStrategy;
use Rocketeer\Interfaces\Strategies\DependenciesStrategyInterface;

class BowerStrategy extends AbstractDependenciesStrategy implements DependenciesStrategyInterface
{
	/**
	 * The name of the manifest file to look for
	 *
	 * @type string
	 */
	protected $manifest = 'bower.json';

	/**
	 * The name of the binary
	 *
	 * @type string
	 */
	protected $binary = 'bower';

	//////////////////////////////////////////////////////////////////////
	////////////////////////////// COMMANDS //////////////////////////////
	//////////////////////////////////////////////////////////////////////

	/**
	 * Install the dependencies
	 *
	 * @return bool
	 */
	public function install()
	{
		return $this->getManager()->runForCurrentRelease('install', [], $this->getInstallationOptions());
	}

	/**
	 * Update the dependencies
	 *
	 * @return boolean
	 */
	public function update()
	{
		return $this->getManager()->runForCurrentRelease('update', [], $this->getInstallationOptions());
	}

	//////////////////////////////////////////////////////////////////////
	////////////////////////////// HELPERS ///////////////////////////////
	//////////////////////////////////////////////////////////////////////

	/**
	 * Get the options to run Bower with
	 *
	 * @return array
	 */
	protected function getInstallationOptions()
	{
		$credentials = $this->connections->getServerCredentials();
		if (array_get($credentials, 'username') == 'root') {
			return ['--allow-root' => null];
		}

		return [];
	}
}