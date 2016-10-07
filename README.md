# tournament-utils

Classes for determining pairings for tournaments.

Currently Round Robin is the only one I've written.

    /* 
     * 5 players
     * ------------------------------------------------
     *          |   R1  |   R2  |   R3  |   R4  |  R5
     * ------------------------------------------------
     * Player 1 | 1 2 3 | 1 - 2 | 1 5 - | 1 4 5 | 1 3 4
     * Player 2 | - 5 4 | 5 4 3 | 4 3 2 | 3 2 - | 2 - 5
     */
     
    $t = new Netsensia\Tournament\RoundRobin\Schedule(5);
    
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