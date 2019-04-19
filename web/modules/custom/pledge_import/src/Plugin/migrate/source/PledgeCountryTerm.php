<?php

namespace Drupal\pledge_import\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for pledge country content.
 *
 * @MigrateSource(
 *   id = "pledge_country_term"
 * )
 */
class PledgeCountryTerm extends SqlBase {

  public function getFields() {
    return [
      'id_country' => $this->t('Country ID'),
      'country' => $this->t('Country name'),
      'nuts_id' => $this->t('Country nuts id'),
      'eu28' => $this->t('Country eu 28'),
      'show_in_list' => $this->t('Show in list'),
      'iso' => $this->t('ISO'),
      'national_pledge_website' => $this->t('Website'),
      'col_order' => $this->t('Order'),
    ];
  }

  /**А
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('country', 'i')
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
      'id_country' => [
        'type' => 'integer',
        'alias' => 'i',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    var_dump($row->getSourceProperty('nuts_id'));
  }
}
