<?php

namespace Drupal\pledge_import\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for pledge update content.
 *
 * @MigrateSource(
 *   id = "pledge_update_paragraph"
 * )
 */
class PledgeUpdateParagraph extends SqlBase {

  public function getFields() {
    return [
      'id_pledge_status' => $this->t('Pledge status ID'),
      'id_pledge' => $this->t('Pledge ID'),
      'id_status' => $this->t('Status ID'),
      'evidence' => $this->t('Evidence'),
      'last_date' => $this->t('Last update'),
    ];
  }

  /**А
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('pledge_status', 'i')
      ->fields('i', array_keys($this->getFields()));
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = $this->getFields();

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'id_pledge_status' => [
        'type' => 'integer',
        'alias' => 'i',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $row->setSourceProperty('last_date', date('Y-m-d\TH:i:s', strtotime($row->getSourceProperty('last_date'))));

    return parent::prepareRow($row);
  }

}
