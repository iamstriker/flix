<?php
namespace sr\gfx;

class VertexArray{
    private $id;
    function __construct(){
        glGenVertexArrays(1, $vaos);
        $this->id = array_pop($vaos);
        echo $this->id."\n";
    }
    function bind(){
        glBindVertexArray($this->id);
    }
    function get(){
        return $this->id;
    }
}
?>