<?php

namespace Drupal\formulario_contacto\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Session\AccountInterface;

/**
* Implements the Simple form controller.
*
* @see \Drupal\Core\Form\FormBase
*/
class Simple extends FormBase {

 protected $database;
 protected $currentUser;
 public function __construct(Connection $database,
 AccountInterface $current_user) {
 $this->database = $database;
 $this->currentUser = $current_user;
 }
 public static function create(ContainerInterface $container) {
 return new static(
 $container->get('database'),
 $container->get('current_user')
 );
 }

 public function buildForm(array $form, FormStateInterface $form_state) {

    $form['title'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Title'),
        '#description' => $this->t('The title must be at least 5 
       characters long.'),
        '#required' => TRUE,
        ];

    $form['color'] = [
         '#type' => 'select',
         '#title' => $this->t('Color'),
         '#options' => [
          0 => $this->t('Black'),
          1 => $this->t('Red'),
          2 => $this->t('Blue'),
          3 => $this->t('Green'),
          4 => $this->t('Orange'),
          5 => $this->t('White'),
        ],
        '#default_value' => 2,
        '#description' => $this->t('Choose a color.'),
    ];

    $form['actions'] = [
        '#type' => 'actions',
    ];
        $form['actions']['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
    ];

 return $form; 
 }
 public function getFormId() {
 return 'formulario_contacto_simple';
 }
 public function validateForm(array &$form, FormStateInterface $form_state) {
 }
 public function submitForm(array &$form, FormStateInterface $form_state) {
 }
}

