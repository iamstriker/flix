<?php
namespace sr\gfx;
require_once("utils/assert.php");

    class E_SHADER{
        const VERTEX = GL_VERTEX_SHADER;
        const FRAGMENT = GL_FRAGMENT_SHADER;
    }

    class Shader{
        use Error;
        private $shader;
        private $path;
        public function __construct($path,$type){
            _assert($type == GL_VERTEX_SHADER || $type == GL_FRAGMENT_SHADER,"Shader type is not Vertex or Fragment");
            $this->shader = glCreateShader($type);
            _assert(file_exists($path),"Could not find $path");
            $this->path = $path;
            return $this;
        }
        public function __deconstruct(){
            glDeleteShader($this->shader);
        }
        public function compile(){
            glShaderSource($this->shader, 1,file_get_contents($this->path), NULL);
            glCompileShader($this->shader);
            return $this;
        }
        public function get(){
            return $this->shader;
        }
    }

    class ShaderProgram{
        private $program;
        public function __construct(){
            $this->program = glCreateProgram();
        }
        public function __deconstruct(){
            glDeleteProgram($this->program);
        }
        public function add(Shader $shader){
            glAttachShader($this->program , $shader->get());
            return $this;
        }
        public function link(){
            //glBindFragDataLocation($shaderProgram, 0, "outColor");
            glLinkProgram($this->program);
            return $this;
        }
        public function not_use(){
            glUseProgram(0);
            return $this;
        }
        public function use() {
            glUseProgram($this->program);
            return $this;        }
        public function get(){
            return $this->program;
        }
    }
?>