<?php
require_once("gfx/error.php");
require_once("gfx/shader.php");
require_once("gfx/attribute.php");
require_once("gfx/buffer.php");
require_once("gfx/uniform.php");
require_once("gfx/vertexarray.php");
require_once("gfx/window.php");
require_once("utils/core.php");


use \sr\gfx\Shader;
use \sr\gfx\ShaderProgram;
use \sr\gfx\E_SHADER;
use \sr\gfx\Window;
use \sr\gfx\Attribute;
use \sr\gfx\Buffer;
use \sr\gfx\VertexArray;
use \sr\gfx\Uniform;


$window = new Window("PHP test application",640,480);
$window->init();

$vertex = (new Shader("shaders/vertex.vsh",E_SHADER::VERTEX))->compile();
$fragment = (new Shader("shaders/fragment.fsh",E_SHADER::FRAGMENT))->compile();

$program = new ShaderProgram();
$program->add($vertex)->add($fragment)->link();

//vertices:
$vertices = [
 
    0.5,  0.5, 0.0,  // top right
    0.5, -0.5, 0.0,  // bottom right
   -0.5, -0.5, 0.0,  // bottom left
   -0.5,  0.5, 0.0   // top left 
];

$elements = [
    0, 1, 3,  // first Triangle
    1, 2, 3   // second Triangle
];

//create buffers:
$vbo = new Buffer();
$ebo = new Buffer();

$vao = new VertexArray();
$vao->bind();

$vbo->bind(GL_ARRAY_BUFFER);
$vbo->data($vertices);

$ebo->bind(GL_ELEMENT_ARRAY_BUFFER);
$ebo->data($elements);

$uniform = new Uniform("ourColor");
$uniform->bind($program);

$program->use();
$pos = new Attribute($program,"position");
$pos->enable();
//glVertexAttribPointer($posAttrib, 2, GL_FLOAT, GL_FALSE, 5 * 4, 0);
$pos->define(3*4);

$app = new \sr\core\App();
$window->show();
$app->update(function($deltatime) use(&$window){
    $window->swap();
    glDrawElements(GL_TRIANGLES, 6, GL_UNSIGNED_INT, NULL);
});


?>