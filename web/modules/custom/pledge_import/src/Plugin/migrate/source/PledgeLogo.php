<?php

namespace Drupal\pledge_import\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for pledge logo.
 *
 * @MigrateSource(
 *   id = "pledge_logo"
 * )
 */
class PledgeLogo extends SqlBase {

  public function getFields() {
    return [
      'id_pledge' => $this->t('Pledge ID'),
      'organization_name' => $this->t('Organization name'),
      'logo_filename' => $this->t('Logo'),
    ];
  }

  /**А
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('pledge', 'i')
      ->fields('i', array_keys($this->getFields()))
      ->condition('id_pledge', 44);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    return $this->getFields();
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'id_pledge' => [
        'type' => 'integer',
        'alias' => 'i',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    return parent::prepareRow($row);
  }
}
