<?php
namespace sr\gfx;
require_once("utils/assert.php");

class Buffer{
    use Error;
    private $id;
    private $type;
    function __construct(){
        glGenBuffers(1, $ids);
        $this->id = array_pop($ids);
    }
    function bind($type){
        _assert(($type == GL_ARRAY_BUFFER || $type == GL_ELEMENT_ARRAY_BUFFER),"type is not supported!");
        $this->type = $type;
        glBindBuffer($type,$this->id);
        return $this;
    }
    function data($vertices,$draw_method = GL_STATIC_DRAW){
        _assert(is_array($vertices),'$vertices is not an array');
        glBufferData($this->type, sizeof($vertices)*4, $vertices, $draw_method);
        return $this;
    }
}