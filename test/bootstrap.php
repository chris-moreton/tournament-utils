<?php

require __DIR__ . '/../vendor/autoload.php';

use Netsensia\Tournament\RoundRobin\Schedule;

// a proxy for testing protected method
class RoundRobinPublicator extends Schedule
{
	public function rotate()
	{
		return $this->rotate();
	}
}
