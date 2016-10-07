<?php

require __DIR__ . '/../vendor/autoload.php';

use Netsensia\Tournament\RoundRobin\Schedule;

// a proxy for testing protected method
class RoundRobinSchedulePublicator extends Schedule
{
	public function rotate()
	{
		return parent::rotate();
	}
}
