<?php
namespace Alr\CliGui;

class Application
{
    public function run(ApplicationInterface $application)
    {
        $core = new $application();
        $keyboard = new Keyboard($core);

        while (true) {
            $core->canvas->resetBuffer();
            $core->run();
            $core->canvas->draw();
            $keyboard->check();
        }
    }
}