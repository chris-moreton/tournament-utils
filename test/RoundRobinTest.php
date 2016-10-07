<?php

require __DIR__ . '/../vendor/autoload.php';

use Netsensia\Tournament\RoundRobin\Schedule;

class RoundRobinTest extends \PHPUnit_Framework_TestCase
{
	public function testInitialPairings()
	{
	    /*
	     * 1
	     * 2
	     */
	    $t = new Schedule(2);
	    $this->assertSame([1, 2], $t->getNextPairing());
	    
	    /*
	     * - 1
	     * 3 2
	     */
	    $t = new Schedule(3);
	    $this->assertSame([2, 3], $t->getNextPairing());
	    
	    /*
	     * 1 2
	     * 4 3
	     */
	    $t = new Schedule(4);
	    $this->assertSame([1, 4], $t->getNextPairing());
	    $this->assertSame([2, 3], $t->getNextPairing());

	    /*
	     * 1 2 3
	     * - 5 4
	     */
	    $t = new Schedule(5);
	    $this->assertSame([2, 5], $t->getNextPairing());
	    $this->assertSame([3, 4], $t->getNextPairing());

	    /*
	     * 1 2 3
	     * 6 5 4
	     */
	    $t = new Schedule(6);
	    $this->assertSame([1, 6], $t->getNextPairing());
	    $this->assertSame([2, 5], $t->getNextPairing());
	    $this->assertSame([3, 4], $t->getNextPairing());
	     
	    /*
	     * 1 2 3 4
	     * - 7 6 5
	     */
	    $t = new Schedule(7);
	    $this->assertSame([2, 7], $t->getNextPairing());
	    $this->assertSame([3, 6], $t->getNextPairing());
	    $this->assertSame([4, 5], $t->getNextPairing());
	}
}

