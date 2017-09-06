<?php
namespace Alr\CliGui\Commands;

use PhpAgent\Agent;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Run extends Command {

    protected function configure()
    {
        $this
            ->setName('run')
            ->setDescription('Execute the agent (You can add this process to supervisord or pm2)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $size = explode(' ',exec('stty size'));



        $map = [
          ['☐','☐','☐','☐','☐','☐','☐','☐','☐','☐','☐','☐'],
          ['☐',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','☐'],
          ['☐',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','☐'],
          ['☐',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','☐'],
          ['☐',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','☐'],
          ['☐',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','☐'],
          ['☐',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','☐'],
          ['☐','☐','☐','☐','☐','☐','☐','☐','☐','☐','☐','☐'],
        ];

        $pl = [4, 6];

        exec('stty -icanon -echo');
        $this->file = fopen('php://stdin', 'r');
        stream_set_blocking($this->file, false);

        $assets = [];

        $exit = true;
        $key = null;
        $bufferedContent = null;
        do{

            $content = "\e[H\e[2J";
            $content .= "\e[120A\e[70D";
//            echo $content;

            if($key == 'd'){
                $pl[0]++;
            }

            $y = 0;
            foreach($map as $row){
                $x = 0;
                foreach($row as $key){

                    if($x == $pl[0] && $y == $pl[1]){
                        $content .= '*';
                    } else {
                        $content .= $key;
                    }
                    $x++;
                }
                $content .= "\n";
                $y++;
            }
            if($bufferedContent != $content) {
                echo $content;
            }

            $bufferedContent = $content;
            $key = fread($this->file, 1);
        } while ($exit);


    }

}