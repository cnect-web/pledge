<?php

namespace Drupal\pledge_import\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for pledge pledge content.
 *
 * @MigrateSource(
 *   id = "pledge_user"
 * )
 */
class PledgeUser extends SqlBase {

  public function getFields() {
    return [
      'contact_email' => $this->t('Contact email'),
    ];
  }

  /**А
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('pledge', 'i')
      ->distinct(TRUE)
      ->fields('i', array_keys($this->getFields()));
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = $this->getFields();
    $fields['name'] = $this->t('Contact name');
    $fields['password'] = $this->t('Contact name');
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'contact_email' => [
        'type' => 'string',
        'alias' => 'i',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    // Extract organizations.
    $value = $this->select('pledge', 'p')
      ->fields('p', ['passwd', 'contact_name'])
      ->condition('contact_email', $row->getSourceProperty('contact_email'))
      ->execute()
      ->fetchAll();

    $row->setSourceProperty('password', $value[0]['passwd']);
    $row->setSourceProperty('name', $value[0]['contact_name']);

    return parent::prepareRow($row);
  }
}
