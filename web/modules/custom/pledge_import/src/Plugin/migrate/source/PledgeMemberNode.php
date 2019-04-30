<?php

namespace Drupal\pledge_import\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\migrate_source_csv\Plugin\migrate\source\CSV;

/**
 * Source plugin for pledge members.
 *
 * @MigrateSource(
 *   id = "pledge_member_node"
 * )
 */
class PledgeMemberNode extends CSV {

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $id_country = $row->getSourceProperty('id_country');
    if (!empty($id_country)) {
      $countries_ids = explode(',', $id_country);
      $items = [];
      foreach ($countries_ids as $id) {
        $items[] = [
          'value' => $id,
        ];
      }

      $row->setSourceProperty('id_country', $items);
    }
    parent::prepareRow($row);
  }
}
