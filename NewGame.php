<?php

namespace App\Games\Blackjack;

class NewGame extends State {

    function __construct($bet) {
        if ($bet >= $this->rules["minBet"] && $bet <= $this->rules["maxBet"]) {
            $this->dealer = new dealer();
            $this->player = new player($bet);
            $this->handInPlay = 0;
        }
    }

    public function begin() {
        
        //if the player has blackjack or the dealer has blackjack and peek is on
        elseif ($this->player->hasBlackjack() || ($this->rules["dealerPeek"] && $this->dealer->hasBlackjack())) 
        {
        	if ($this->dealer->showsAce()) {
            	return new PlayerAction($this);
			} 
            return new EndGame($this);
        }
        else 
        {
            return new PlayerAction($this);
        }
    }
}
