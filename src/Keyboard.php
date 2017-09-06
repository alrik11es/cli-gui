<?php
namespace Alr\CliGui;

use Alr\CliGui\Events\KeyDown;
use Alr\CliGui\Events\KeyUp;
use Symfony\Component\EventDispatcher\Event;

class Keyboard
{
    private $pointer;
    private $core;
    private $keyPressing = null;

    public function __construct(Core $core)
    {
        $this->core = $core;
        exec('stty -icanon -echo');
        $this->pointer = fopen('php://stdin', 'r');
        stream_set_blocking($this->pointer, false);
    }

    public function check()
    {
        $key = fread($this->pointer, 1);

        if(empty($this->keyPressing) && $this->keyPressing != $key) {
            $this->core->eventDispatcher->dispatch(KeyDown::NAME, new KeyDown($key));
        }

        $this->keyPressing = $key;

    }
//
//    public function keyDown($key)
//    {
//        $this->core->eventDispatcher->dispatch(KeyDown::NAME, new KeyDown($key));
//    }
//
//    public function keyUp($key)
//    {
//        $this->core->eventDispatcher->dispatch(KeyUp::NAME, new KeyUp($key));
//    }

}