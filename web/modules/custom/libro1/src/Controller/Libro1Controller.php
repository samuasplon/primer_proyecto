<?php

namespace Drupal\libro1\Controller;

class ArticleController {

  public function page() {

    $items = array(
      array('name' => 'Título: La sombra del viento'),
      array('name' => 'Autor: Carlos Ruiz Zafón'),
      array('name' => 'Article three'),
      array('name' => 'Article four'),
    );

    return array(
      '#theme' => 'article_description',
      '#items' => $items,
      '#title' => 'La sombra del viento'
    );
  }
}
