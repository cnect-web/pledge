<?php

namespace Drupal\pledge_import\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for pledge milestone content.
 *
 * @MigrateSource(
 *   id = "pledge_milestone_paragraph"
 * )
 */
class PledgeMilestoneParagraph extends SqlBase {

  public function getFields() {
    return [
      'id_milestone' => $this->t('Milestone ID'),
      'id_pledge' => $this->t('Pledge ID'),
      'milestone_name' => $this->t('milestone name'),
      'completion_date' => $this->t('completion date'),
      'status' => $this->t('status'),
      'last_update' => $this->t('last update'),
    ];
  }

  /**А
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('pledge_milestones', 'i')
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
      'id_milestone' => [
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
    $row->setSourceProperty('completion_date', date('Y-m-d\TH:i:s', strtotime($row->getSourceProperty('completion_date'))));

    return parent::prepareRow($row);
  }

}
