<?php
namespace Alr\CliGui;

class Application
{
    public function run(ApplicationInterface $application)
    {
        $core = new $application();
        if(method_exists($core, 'init')){
            $core->init();
        }

        $keyboard = new Keyboard($core);

        while (true) {
            $core->canvas->resetBuffer();
            $core->main();
            $core->canvas->draw();
            $keyboard->check();
        }
    }
}