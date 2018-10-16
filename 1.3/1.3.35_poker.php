<?php
class CardDealer{
    private $cards=[];
    function __construct(){
        //$kinds=["spades","diamonds","clubs","hearts"];//黑桃 方块 梅花 红桃
        $kinds=["♠️","♦️","♣️","♥️"];
        $values=["A","2","3","4","5","6","7","8","9","10","J","Q","K"];
        foreach($kinds as $kind){
            foreach($values as $value){
                $this->cards[]=new Card($kind,$value);
            }
        }
        print_r($this->cards);
    }
    public function deal(int $playerNumber=4){
        $players=[];
        for($i=0;$i<$playerNumber;$i++){
            $players[]=new Player('player'.$i+1);
        }

    }
}
class Card{
    private $kind;
    private $value;
    function __construct($kind,$value){
        $this->kind=$kind;
        $this->value=$value;
    }
}
class Player{
    private $number="";
    private $cards=[];
    function __construct($number){

    }
    function addCard(Card $card){
        $this->cards[]=$card;
    }
}
$dealer=new CardDealer();