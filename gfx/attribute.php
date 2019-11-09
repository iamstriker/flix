<?php
namespace sr\gfx;

class Attribute{
    private $attr;
    function __construct(ShaderProgram $program,string $name){
        $this->attr = glGetAttribLocation($program->get(), $name);
    }
    public function enable(){
        glEnableVertexAttribArray($this->attr);
        return $this;
    }
    public function define($stride,$size = 2,$pointer = 0,$type = GL_FLOAT,$normalized = GL_FALSE){
        glVertexAttribPointer($this->attr, $size, $type, $normalized, $stride, $pointer);
        return $this;
    }
    function location(){
        return $this->$attr;
    }
}