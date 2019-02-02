<?php
require_once("gfx/shader.php");
require_once("gfx/attribute.php");
require_once("gfx/buffer.php");
require_once("gfx/vertexarray.php");
require_once("gfx/window.php");

use \sr\gfx\Shader;
use \sr\gfx\ShaderProgram;
use \sr\gfx\E_SHADER;
use \sr\gfx\Window;
use \sr\gfx\Attribute;
use \sr\gfx\Buffer;
use \sr\gfx\VertexArray;


$window = new Window("PHP test application",640,480);
$window->init();

$vertex = new Shader("shaders/vertex.vsh",E_SHADER::VERTEX);
$fragment = new Shader("shaders/fragment.fsh",E_SHADER::FRAGMENT);
$vertex->compile();
$fragment->compile();

$program = new ShaderProgram();
$program->add($vertex);
$program->add($fragment);
$program->link();

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

$program->use();
$pos = new Attribute($program,"position");
$pos->enable();
//glVertexAttribPointer($posAttrib, 2, GL_FLOAT, GL_FALSE, 5 * 4, 0);
$pos->define(3*4);

$event = new SDL_Event;
$deltaTime = 0;
$frames = 0;
$fps = 0;
$start = time();
$window->show();

while(true) {
    // Clear the screen to black
    glClearColor(0, 0.0, 1.0, 1.0);
    glClear(GL_COLOR_BUFFER_BIT);
    // Draw a rectangle from the 2 triangles using 6 indices
    glDrawElements(GL_TRIANGLES, 6, GL_UNSIGNED_INT, NULL);
	$window->swap();
    SDL_PollEvent($event);
    if($event->type == SDL_KEYDOWN || $event->type == SDL_QUIT) break;
    $end = time();
    if ($end - $start > 0.25)
    {
        $fps = $frames / ($end - $start);
        $start = $end;
        $frames = 0;
    }
    ++$frames;
}
?>