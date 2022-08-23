<?php
class Message extends ContentEntityBase implements MessageInterface {
 use EntityChangedTrait;
 /**
 * {@inheritdoc}
 */
 public static function preCreate(EntityStorageInterface 
$storage_controller, array &$values) {
 parent::preCreate($storage_controller, $values);
 $values += array(
 'user_id' => \Drupal::currentUser()->id(),
 );
 }
 public function getType() {
 return $this->bundle();
 }
 public function getSubject() {
 return $this->get('subject')->value;
 }
 public function setSubject($subject) {
 $this->set('subject', $subject);
 return $this;
 }
 public function getCreatedTime() {
 return $this->get('created')->value;
 }
 public function setCreatedTime($timestamp) {
 $this->set('created', $timestamp);
 return $this;
 }
 public function getOwner() {
    return $this->get('user_id')->entity;
    }
    public function getOwnerId() {
    return $this->get('user_id')->target_id;
    }
    public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
    }
    public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
    }
    public function isPublished() {
    return (bool) $this->getEntityKey('status');
    }
    public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
    }
    
    public function getUserToId() {
    return $this->get('user_to')->target_id;
    }
    
    public function setUserToId($uid) {
    $this->set('user_to', $uid);
    return $this;
    }
    public function getUserTo() {
    return $this->get('user_to')->entity;
    } 
    
    public function setUserTo(UserInterface $account) {
    $this->set('user_to', $account->id());
    return $this;
    }
    
    public function getContent() {
    return $this->get('content')->value;
    }
    public function setContent($content) {
    $this->set('content', $content);
    return $this;
    } 
    
    public function isRead() {
    return (bool) $this->getEntityKey('is_read');
    }
    public function setRead($read) {
    $this->set('is_read', $read ? TRUE : FALSE);
    return $this;
    }

// ...

public static function baseFieldDefinitions(EntityTypeInterface 
$entity_type) {
 $fields = parent::baseFieldDefinitions($entity_type);
 $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
 ->setLabel(t('Authored by'))
 ->setDescription(t('The user ID of author of the Message entity.'))
 ->setRevisionable(TRUE)
 ->setSetting('target_type', 'user')
 ->setSetting('handler', 'default')
 ->setTranslatable(TRUE)
 ->setDisplayOptions('view', array(
 'label' => 'hidden',
 'type' => 'author',
 'weight' => 0,
 ))
 ->setDisplayOptions('form', array(
 'type' => 'entity_reference_autocomplete',
 'weight' => 5,
 'settings' => array(
 'match_operator' => 'CONTAINS',
 'size' => '60',
 'autocomplete_type' => 'tags',
 'placeholder' => '',
 ),
 ))
 ->setDisplayConfigurable('form', TRUE)
 ->setDisplayConfigurable('view', TRUE);
 
 $fields['user_to'] = BaseFieldDefinition::create('entity_reference')
 ->setLabel(t('To'))
 ->setDescription(t('The user ID of the Message recipient.'))
 ->setRevisionable(TRUE)
 ->setSetting('target_type', 'user')
 ->setSetting('handler', 'default')
 ->setTranslatable(TRUE)
 ->setDisplayOptions('view', array(
 'label' => 'To',
 'type' => 'author',
 'weight' => 0,
 ))
 ->setDisplayOptions('form', array(
 'type' => 'entity_reference_autocomplete',
 'weight' => 5,
 'settings' => array(
 'match_operator' => 'CONTAINS',
 'size' => '60',
 'autocomplete_type' => 'tags',
 'placeholder' => '',
 ),
 ))
 ->setDisplayConfigurable('form', TRUE)
 ->setDisplayConfigurable('view', TRUE);
 
 $fields['subject'] = BaseFieldDefinition::create('string')
 ->setLabel(t('Subject'))
 ->setDescription(t('The subject of the Message entity.'))
 ->setSettings(array(
 'max_length' => 100,
 'text_processing' => 0,
 ))
 ->setDefaultValue('')
 ->setDisplayOptions('view', array(
 'label' => 'above',
 'type' => 'string',
 'weight' => -4,
 ))
 ->setDisplayOptions('form', array(
 'type' => 'string_textfield',
 'weight' => -4,
 ))
 ->setDisplayConfigurable('form', TRUE)
 ->setDisplayConfigurable('view', TRUE);
 $fields['content'] = BaseFieldDefinition::create('text_long')
 ->setLabel(t('Content'))
 ->setDescription(t('The content of the Message'))
 ->setTranslatable(TRUE)
 ->setDisplayOptions('view', array(
 'label' => 'hidden',
 'type' => 'text_default',
 'weight' => 0,
 ))
 ->setDisplayConfigurable('view', TRUE)
 ->setDisplayOptions('form', array(
 'type' => 'text_textfield',
 'weight' => 0,
 ))
 ->setDisplayConfigurable('form', TRUE); 
 
 $fields['is_read'] = BaseFieldDefinition::create('boolean')
 ->setLabel(t('Read'))
 ->setDescription(t('A boolean indicating whether the Message is read.'))
 ->setDefaultValue(FALSE);
 
 $fields['status'] = BaseFieldDefinition::create('boolean')
 ->setLabel(t('Publishing status'))
 ->setDescription(t('A boolean indicating whether the Message is 
published.'))
 ->setDefaultValue(TRUE);
 $fields['created'] = BaseFieldDefinition::create('created')
 ->setLabel(t('Created'))
 ->setDescription(t('The time that the entity was created.'));
 $fields['changed'] = BaseFieldDefinition::create('changed')
 ->setLabel(t('Changed'))
 ->setDescription(t('The time that the entity was last edited.'));
 return $fields;
 }
}

