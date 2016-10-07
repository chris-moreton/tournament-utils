# tournament-utils

Classes for scheduling tournaments.

Work in progress. Not fully functional - README file will update with each addition.

    /* 7 players
     * ---------
     * 1 2 3 4
     * - 7 6 5
     */
             
    $t = new Schedule(7);
    $t->getNextPairing() = [2,7]
    $t->getNextPairing() = [3,6]
    $t->getNextPairing() = [4,5]
    
