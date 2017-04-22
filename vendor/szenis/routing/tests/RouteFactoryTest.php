<?php

/*
 * This file is part of the Simple-PHP-Router package.
 *
 * (c) Stein Janssen <birdmage@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RouterTests;

/**
 * Test route factory
 */
class RouteFactoryTest extends BaseTest
{
	/**
	 * Test if the factory created a Route object
	 */
	public function testCreateRoute()
	{
		$factory = new \Szenis\RouteFactory();
		$response = $factory->create('/', 'GET', function(){});

		$this->assertInstanceOf('\Szenis\Route', $response);
	}
}
