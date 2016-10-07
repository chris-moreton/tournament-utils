<?php
namespace Netsensia\Tournament\RoundRobin;

class Schedule
{
    private $player1Array = [];
    private $player2Array = [];
    private $matchNum = 0;
    private $matchesPerRound;
    private $numPlayers;
    
    /**
     * @param number $numPlayers
     */
    public function __construct($numPlayers)
    {
        $this->numPlayers = $numPlayers;
        
        if ($numPlayers % 2 == 1) {
            $numPlayers ++;
            $includeDummyPlayer = true;
        } else {
            $includeDummyPlayer = false;
        }
        
        $half = $numPlayers / 2;
        
        for ($i=0; $i<$half; $i++) {
            $player1Array[] = $i;
        }
        
        for ($i=$numPlayers-1; $i>=0; $i--) {
            $player2Array[] = $i;
        }
        
        if ($includeDummyPlayer) {
            $player1Array[0] = null;
        }
        
        $this->matchesPerRound = $half;
        
    }
    
    /**
     * Rotate the arrays while keeping player 1 fixed, e.g.
     * 
     * 1 2 3 4
     * 8 7 6 5
     * 
     * Rotated clockwise (fixing player 1) becomes
     * 
     * 1 8 2 3
     * 7 6 5 4
     */
    private function rotate()
    {
        
    }
    
    /**
     * Get the next pairing for the current round
     * 
     * @return number[]
     */
    public function getNextPairing()
    {
        if ($this->matchNum == $this->matchesPerRound) {
            $this->rotate();
            if ($this->player2Array[0] == $this->numPlayers-1) {
                // back where we started
                return null;
            }
        }
        
        do {
            $player1 = $this->player1Array[$this->matchNum];
            $player2 = $this->player2Array[$this->matchNum];
            $this->matchNum ++;
        } while ($player1 == null); // if there is null player it will never be player 2
        
        return [
            'player1' => $player1,
            'player2' => $player2,
        ];
    }
}

