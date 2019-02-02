<?php
namespace sr\gfx;
class Window{
    private $name;
    private $width;
    private $height;
    private $window;
    function __construct($name,$width,$height){
        $this->name = $name;
        $this->width = $width;
        $this->height = $height;        
    }
    function init($gl_context_major = 3,$gl_context_minor = 3){
        SDL_Init(SDL_INIT_EVERYTHING);
        SDL_GL_SetAttribute(SDL_GL_CONTEXT_MAJOR_VERSION, $gl_context_major);
        SDL_GL_SetAttribute(SDL_GL_CONTEXT_MINOR_VERSION, $gl_context_minor);
        SDL_GL_SetAttribute(SDL_GL_CONTEXT_PROFILE_MASK, SDL_GL_CONTEXT_PROFILE_CORE);
        $this->window = SDL_CreateWindow($this->name, SDL_WINDOWPOS_CENTERED, SDL_WINDOWPOS_CENTERED,                
                        $this->width, $this->height, SDL_WINDOW_OPENGL);                                                                                            
        SDL_GL_CreateContext($this->window);
    }
    function show(){
        SDL_ShowWindow($this->window);
    }
    function swap(){
        SDL_GL_SwapWindow($this->window);
    }
}
?>