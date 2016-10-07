<?php
namespace Netsensia\Tournament\RoundRobin;

class Schedule
{
    private $player1Array = [];
    private $player2Array = [];
    private $matchNum = 0;
    private $matchesPerRound;
    private $numPlayers;
    private $roundNum = 1;

    /**
     * @param number $numPlayers
     */
    public function __construct($numPlayers)
    {
        $this->numPlayers = $numPlayers;
        $this->reset();
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
    protected function rotate()
    {
        if ($this->matchesPerRound > 1) {
            
            $bottomLeft = $this->player2Array[0];
            
            for ($i=0; $i<$this->matchesPerRound-1; $i++) {
                $this->player2Array[$i] = $this->player2Array[$i+1];
            }
            
            $this->player2Array[$this->matchesPerRound-1] = $this->player1Array[$this->matchesPerRound-1];
            
            for ($i=$this->matchesPerRound-1; $i>1; $i--) {
                $this->player1Array[$i] = $this->player1Array[$i-1];
            }
            
            $this->player1Array[1] = $bottomLeft;
        }
    }
    
    /**
     * Reset the tournament to the start
     */
    public function reset()
    {
        if ($this->numPlayers % 2 == 1) {
            $this->numPlayers ++;
            $includeDummyPlayer = true;
        } else {
            $includeDummyPlayer = false;
        }
        
        $this->matchesPerRound = $this->numPlayers / 2;
        
        for ($i=1; $i<=$this->matchesPerRound; $i++) {
            $this->player1Array[] = $i;
        }
        
        for ($i=$this->numPlayers; $i>$this->matchesPerRound; $i--) {
            $this->player2Array[] = $i;
        }
        
        if ($includeDummyPlayer) {
            $this->player2Array[0] = 0;
        }
        
        $this->roundNum = 1;
    }
    
    /**
     * Get the next pairing for the current round
     * 
     * @return number[]
     */
    public function getNextPairing()
    {
        if ($this->matchNum == $this->matchesPerRound) {
            $this->roundNum ++;
            $this->matchNum = 0;
            $this->rotate();
            if ($this->player2Array[0] == $this->numPlayers ||
                $this->player2Array[0] == 0) {
                // back where we started
                return null;
            }
        }
        
        $player1 = $this->player1Array[$this->matchNum];
        $player2 = $this->player2Array[$this->matchNum];
        $this->matchNum ++;
        
        if ($player1 == 0 || $player2 == 0) {
            return $this->getNextPairing();
        } else {
            return [$player1, $player2, $this->roundNum];
        }
    }
}

