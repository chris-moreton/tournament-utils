# tournament-utils

Classes for determining pairings for tournaments.

Currently Round Robin is the only one I've written.

## Getting started

From the root of your application

    composer require chris-moreton/tournament-utils
    
Unless using a framework where autoloading is already taken care of, you'll need to

    include 'vendor/autoload.php';
    
    /* 
     * 5 players
     * ------------------------------------------------
     *          |   R1  |   R2  |   R3  |   R4  |  R5
     * ------------------------------------------------
     * Player 1 | 1 2 3 | 1 - 2 | 1 5 - | 1 4 5 | 1 3 4
     * Player 2 | - 5 4 | 5 4 3 | 4 3 2 | 3 2 - | 2 - 5
     */
     
    $t = new Netsensia\Tournament\RoundRobin\Schedule(5);
    
    // [player1, player2, round_number]
    
    [2,5,1] == $t->getNextPairing();
    [3,4,1] == $t->getNextPairing();
    [1,5,2] == $t->getNextPairing();
    [2,3,2] == $t->getNextPairing();
    [1,4,3] == $t->getNextPairing();
    [5,3,3] == $t->getNextPairing();
    [1,3,4] == $t->getNextPairing();
    [4,2,4] == $t->getNextPairing();
    [1,2,5] == $t->getNextPairing();
    [4,5,5] == $t->getNextPairing();
     
    null == $t->getNextPairing();