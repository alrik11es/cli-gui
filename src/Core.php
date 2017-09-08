<?php
namespace Alr\CliGui;

use Alr\CliGui\Events\KeyDown;
use Alr\CliGui\Events\KeyUp;
use Symfony\Component\EventDispatcher\EventDispatcher;

abstract class Core
{
    public $eventDispatcher;
    public $lastBuffer;
    public $canvas;

    public function __construct()
    {
        $this->eventDispatcher = new EventDispatcher();
        $this->canvas = new Canvas();
    }
}