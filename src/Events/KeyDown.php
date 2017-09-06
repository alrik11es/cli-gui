<?php
namespace Alr\CliGui\Events;

use Symfony\Component\EventDispatcher\Event;

class KeyDown extends Event
{
    const NAME = 'keyboard.keyDown';

    protected $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }
}