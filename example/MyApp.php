<?php
include '../vendor/autoload.php';

class MyApp extends \Alr\CliGui\Core implements \Alr\CliGui\ApplicationInterface
{

    public $map = [
        ['|','|','|','|','|','|','|','|','|','|','|','|','|','|','|','|','|','|','|','|','|','|'],
        ['|',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','|'],
        ['|',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','|'],
        ['|',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','|'],
        ['|',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','|'],
        ['|',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','|'],
        ['|',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','|'],
        ['|','|','|','|','|','|','|','|','|','|','|','|','|','|','|','|','|','|','|','|','|','|'],
    ];
    public $pl = [4, 6];

    public function run()
    {

        $this->canvas->addToBuffer('FPS: '.$this->canvas->getFPS().PHP_EOL);

        $y = 0;
        foreach($this->map as $row){
            $x = 0;
            foreach($row as $key){

                if($x == $this->pl[0] && $y == $this->pl[1]){
                    $this->canvas->addToBuffer('*');
                } else {
                    $this->canvas->addToBuffer($key);
                }
                $x++;
            }
            $this->canvas->addToBuffer("\n");
            $y++;
        }

        $this->eventDispatcher->addListener(\Alr\CliGui\Events\KeyDown::NAME, function($key){
            if($key->getKey() == 'd'){
                $this->pl[0]++;
            }
            if($key->getKey() == 'a'){
                $this->pl[0]--;
            }
            if($key->getKey() == 's'){
                $this->pl[1]++;
            }
            if($key->getKey() == 'w'){
                $this->pl[1]--;
            }
            $key->stopPropagation();
        });
    }
}

$app = new \Alr\CliGui\Application();
$app->run(new MyApp());