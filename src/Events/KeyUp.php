<?php
namespace Alr\CliGui\Events;

use Symfony\Component\EventDispatcher\Event;

class KeyUp extends Event
{
    const NAME = 'keyboard.keyUp';

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