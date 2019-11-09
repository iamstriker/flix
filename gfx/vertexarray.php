<?php
namespace sr\gfx;

class VertexArray{
    private $id;
    function __construct(){
        glGenVertexArrays(1, $vaos);
        $this->id = array_pop($vaos);
    }
    function bind(){
        glBindVertexArray($this->id);
        return $this;
    }
    function get(){
        return $this->id;
    }
}
?>