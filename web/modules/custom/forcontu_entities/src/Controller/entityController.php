<?php

/**
* Implements ENTITY_TYPE_create() for node.
*/

use \Drupal\Core\Entity\EntityInterface;

function forcontu_entities_node_create(\Drupal\Core\Entity\EntityInterface $entity) {
 
 \Drupal::logger('forcontu_entities')->info('Node created: @label',
 ['@label' => $entity->label()]);
}
