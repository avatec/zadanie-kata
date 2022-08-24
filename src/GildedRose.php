<?php

namespace App;

final class GildedRose
{
    protected $item;

    /**
     * Update quantity
     * @param int $quantity
     */
    
    public function updateQuality(Item $item)
    {
        $this->item = $item;

        if ($this->notAgedBrie() && $this->notBackstage()) {
            $this->qualityMoreThenZero();
        } else {
            $this->qualityLessThenFifty();
        }

        if ($this->notSulfuras()) {
            $this->item->sell_in = $this->item->sell_in - 1;
        }

        $this->sellInLessThenZero($item);
    }

    /**
     * Return boolean for name compared to Sulfuras
     * @return boolean
     */
    private function notBackstage()
    {
        return $this->item->name != 'Backstage passes to a TAFKAL80ETC concert' ? true : false;
    }

    /**
     * Return boolean for name compared to Sulfuras
     * @return boolean
     */
    private function notSulfuras()
    {
        return $this->item->name != 'Sulfuras, Hand of Ragnaros' ? true : false;
    }

    /**
     * Return boolean for name compared to Aged Brie
     * @return boolean
     */
    private function notAgedBrie()
    {
        return $this->item->name != 'Aged Brie' ? true : false;
    }

    /**
     * If quality is more than zero then set $quality
     */
    private function qualityMoreThenZero()
    {
        if (!$this->notSulfuras()) {
            $this->item->quality = 80;
            return;
        }

        $this->item->quality = $this->item->quality - 1;
        return;
    }

    /**
     * If quality is less then fifty
     */
    private function qualityLessThenFifty()
    {
        if ($this->item->quality < 50) {
            $this->item->quality = $this->item->quality + 1;

            $this->ifBackstagePasses();
        }
    }

    /**
     * Update quantity for for Backstage passes
     */
    private function ifBackstagePasses()
    {
        if ($this->notBackstage()) {
            return;
        }

        if ($this->item->sell_in < 11) {
            $this->item->quality = $this->item->quality + 1;
        }

        if ($this->item->sell_in < 6) {
            $this->item->quality = $this->item->quality + 1;
        }
    }

    /**
     * Operations for sellIn less then zero
     */
    private function sellInLessThenZero()
    {
        if ($this->item->sell_in >= 0) {
            return;
        }

        if( $this->notAgedBrie() && $this->notBackstage() && $this->notSulfuras()) {
            $this->item->quality = $this->item->quality - 1;
        }

        if ($this->notAgedBrie() && !$this->notBackstage()) {
            $this->item->quality = $this->item->quality - $this->item->quality;
        }

        if (!$this->notAgedBrie() && $this->item->quality < 50) {
            $this->item->quality = $this->item->quality + 1;
        }
    }
}
