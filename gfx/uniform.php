<?php
namespace sr\gfx;
class Uniform {
    use Error;

    private $uniform_name;
    private $location;
    function __construct($uniform_name){
        $this->uniform_name = $uniform_name;
    }
    function bind($shader_program){
        $id = $shader_program->get();
        $this->location = glGetUniformLocation($id, $this->uniform_name);
        $shader_program->use();
        return $this;
    }

    function float($float){
        glUniform1f($this->location,$float);
        return $this;
    }
    function float2($float0,$float1){
        glUniform2f($this->location,$float0,$float1);
        return $this;
    }
    function float3($float0,$float1,$float2,$float3){
        glUniform3f($this->location,$float0,$float1,$float2);
        return $this;
    }
    function float4($float0,$float1,$float2,$float3){
        glUniform4f($this->location,$float0,$float1,$float2,$float3);
        return $this;
    }
    function vec2f($vec){
        glUniform2f($this->location,$vec[0],$vec[1]);
        return $this;
    }
    function vec3f($vec){
        glUniform3f($this->location,$vec[0],$vec[1],$vec[2]);
        return $this;
    }
    function vec4f($vec){
        glUniform4f($this->location,$vec[0],$vec[1],$vec[2],$vec[3]);
        return $this;
    }
    function int($int){
        glUniform1i($this->location,$int);
        return $this;
    }
    function int2($int0,$int1){
        glUniform2i($this->location,$int0,$int1);
        return $this;
    }
    function int3($int0,$int1,$int2,$int3){
        glUniform3i($this->location,$int0,$int1,$int2);
        return $this;
    }
    function int4($int0,$int1,$int2,$int3){
        glUniform4i($this->location,$int0,$int1,$int2,$int3);
        return $this;
    }
    function vec2i($vec){
        glUniform2i($this->location,$vec[0],$vec[1]);
        return $this;
    }
    function vec3i($vec){
        glUniform3i($this->location,$vec[0],$vec[1],$vec[2]);
        return $this;
    }
    function vec4i($vec){
        glUniform4i($this->location,$vec[0],$vec[1],$vec[2],$vec[3]);
        return $this;
    }
}
?>