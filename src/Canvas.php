<?php
namespace Alr\CliGui;

class Canvas
{
    protected $buffer;
    protected $lastBuffer;

    private $currentSecond;
    private $framesInSecond;
    private $fps;

    public function getFPS()
    {
        if ($this->currentSecond != time()) {
            $this->fps = $this->framesInSecond;
            $this->currentSecond = time();
            $this->framesInSecond = 1;
        } else {
            ++$this->framesInSecond;
        }
        return $this->fps;
    }

    public function addToBuffer($data)
    {
        $this->buffer .= $data;
    }

    public function resetBuffer()
    {
//        $size = explode(' ',exec('stty size'));
        $this->buffer = "\e[H\e[2J";
//        $this->buffer .= "\e[{$size[0]}A\e[{$size[1]}D";
    }

    public function draw()
    {
        if($this->buffer != $this->lastBuffer) {
            echo $this->buffer;
        }
        $this->lastBuffer = $this->buffer;
    }

}