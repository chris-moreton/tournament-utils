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
	     * 1 2
	     * - 3
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
	
	public function testRotate()
	{
	    /*
	     * 1
	     * 2
	     */
	    $t = new RoundRobinSchedulePublicator(2);
	    $t->rotate();
	    $this->assertSame([1,2], $t->getNextPairing());
	    
	    /*
	     * 1 2
	     * - 3
	     *
	     * Rotated:
	     * 1 -
	     * 3 2
	     *
	     * Rotated again:
	     * 1 3
	     * 2 -
	     */
	    $t = new RoundRobinSchedulePublicator(3);
	    $t->rotate();
	    $this->assertSame([1,3], $t->getNextPairing());
	    
	    $t = new RoundRobinSchedulePublicator(3);
	    $t->rotate();
	    $t->rotate();
	    $this->assertSame([1,2], $t->getNextPairing());
	    
	    /*
	     * 1 2 3
	     * 6 5 4
	     * 
	     * 1 6 2
	     * 5 4 3
	     */
	    $t = new RoundRobinSchedulePublicator(6);
	    $t->rotate();
	    $this->assertSame([1,5], $t->getNextPairing());
	    $this->assertSame([6,4], $t->getNextPairing());
	    $this->assertSame([2,3], $t->getNextPairing());
	}
	
	
	public function testEndOfTournament()
	{
	    /*
	     * 1 2 3|1 - 2|1 5 -|1 4 5|1 3 4|1 2 3 <- Back where we started
	     * - 5 4|5 4 3|4 3 2|3 2 -|2 - 5|- 5 4
	     */
	    $t = new RoundRobinSchedulePublicator(5);
	    $this->assertSame([2,5], $t->getNextPairing());
	    $this->assertSame([3,4], $t->getNextPairing());
	    $this->assertSame([1,5], $t->getNextPairing());
	    $this->assertSame([2,3], $t->getNextPairing());
	    $this->assertSame([1,4], $t->getNextPairing());
	    $this->assertSame([5,3], $t->getNextPairing());
	    $this->assertSame([1,3], $t->getNextPairing());
	    $this->assertSame([4,2], $t->getNextPairing());
	    $this->assertSame([1,2], $t->getNextPairing());
	    $this->assertSame([4,5], $t->getNextPairing());
	     
	    $this->assertSame(null, $t->getNextPairing());
	    
	    
	    /*
	     * 1 2 3|1 6 2|1 5 6|1 4 5|1 3 4|1 2 3 <- Back where we started
	     * 6 5 4|5 4 3|4 3 2|3 2 6|2 6 5|6 5 4
	     */
	    $t = new RoundRobinSchedulePublicator(6);
	    $this->assertSame([1,6], $t->getNextPairing());
	    $this->assertSame([2,5], $t->getNextPairing());
	    $this->assertSame([3,4], $t->getNextPairing());
	    $this->assertSame([1,5], $t->getNextPairing());
	    $this->assertSame([6,4], $t->getNextPairing());
	    $this->assertSame([2,3], $t->getNextPairing());
	    $this->assertSame([1,4], $t->getNextPairing());
	    $this->assertSame([5,3], $t->getNextPairing());
	    $this->assertSame([6,2], $t->getNextPairing());
	    $this->assertSame([1,3], $t->getNextPairing());
	    $this->assertSame([4,2], $t->getNextPairing());
	    $this->assertSame([5,6], $t->getNextPairing());
	    $this->assertSame([1,2], $t->getNextPairing());
	    $this->assertSame([3,6], $t->getNextPairing());
	    $this->assertSame([4,5], $t->getNextPairing());
	    
	    $this->assertSame(null, $t->getNextPairing());
  
	}
}

