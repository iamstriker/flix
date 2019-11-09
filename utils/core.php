<?php
namespace sr\core;
class App{
    private $event;
    private $deltaTime;
    private $frames;
    private $fps;
    private $start;
    private $can_run;

    function __construct(){
        $this->event = new \SDL_Event;
        $this->deltaTime = 0;
        $this->frames = 0;
        $this->fps = 0;
        $this->start = time();
        $this->can_run = true;
    }

    function update($update_loop){
        while($this->can_run) {
            if($this->event->type == SDL_KEYDOWN || $this->event->type == SDL_QUIT) $this->can_run = false;
            $update_loop($this->deltaTime);
            SDL_PollEvent($this->event);
            $end = time();
            if ($end - $this->start > 0.25)
            {
                $this->fps = $this->frames / ($end - $this->start);
                $this->start = $end;
                $this->frames = 0;
            }
            ++$this->frames;
        }
    }
}

?>