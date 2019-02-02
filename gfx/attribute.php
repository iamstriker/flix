<?php
namespace sr\gfx;

class Attribute{
    private $attr;
    function __construct(ShaderProgram $program,string $name){
        $this->attr = glGetAttribLocation($program->get(), $name);
    }
    public function enable(){
        glEnableVertexAttribArray($this->attr);
    }
    public function define($stride,$size = 2,$pointer = 0){
        glVertexAttribPointer($this->attr, $size, GL_FLOAT, GL_FALSE, $stride, $pointer);
    }
    function location(){
        return $this->$attr;
    }
}