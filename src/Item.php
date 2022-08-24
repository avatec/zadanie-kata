<?php

namespace App;

use Exception;

final class Item
{
    public $name;
    public $sell_in;
    public $quality;

    public function __construct(string $name, int $sell_in, int $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;

        // Items cannot be less then 0
        if ($quality <= 0) {
            throw new Exception('Quality cannot be less then zero');
        }

        $this->quality = $quality;
    }

    public function __toString()
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }
}
