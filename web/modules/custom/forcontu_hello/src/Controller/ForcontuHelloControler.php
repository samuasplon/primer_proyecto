<?php

/**
* @file
* Contains \Drupal\forcontu_hello\Controller\ForcontuHelloController.
*/
namespace Drupal\forcontu_hello\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
* Controlador para devolver el contenido de las páginas definidas
*/

class ForcontuHelloController extends ControllerBase {

 public function hello() {
 return array(
 '#markup' => '<p>' . 'Hello, Forcontu! This is my 
first module in Drupal 8!' . '</p>',
   );
 }
}
