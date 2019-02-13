<?php

namespace Drupal\pledge_import\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for pledge impact content.
 *
 * @MigrateSource(
 *   id = "pledge_impact_paragraph"
 * )
 */
class PledgeImpactParagraph extends SqlBase {

  public function getFields() {
    return [
      'id_impact' => $this->t('Impact ID'),
      'id_pledge' => $this->t('Pledge ID'),
      'indicator_name' => $this->t('indicator name'),
      'indicator_desc' => $this->t('indicator description'),
      'indicator_target' => $this->t('indicator target'),
      'indicator_status' => $this->t('indicator status'),
      'last_update' => $this->t('last update'),
    ];
  }

  /**А
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('pledge_impact', 'i')
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
      'id_impact' => [
        'type' => 'integer',
        'alias' => 'i',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $row->setSourceProperty('last_update', date('Y-m-d\TH:i:s', strtotime($row->getSourceProperty('last_update'))));

    return parent::prepareRow($row);
  }

}
