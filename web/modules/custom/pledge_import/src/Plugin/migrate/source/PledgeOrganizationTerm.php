<?php

namespace Drupal\pledge_import\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for pledge organization content.
 *
 * @MigrateSource(
 *   id = "pledge_organization_term"
 * )
 */
class PledgeOrganizationTerm extends SqlBase {

  public function getFields() {
    return [
      'id_org' => $this->t('Organization ID'),
      'org_name' => $this->t('Organization name'),
      'org_description' => $this->t('Organization description'),
      'org_website' => $this->t('Organization website'),
    ];
  }

  /**А
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('organization', 'i')
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
      'id_org' => [
        'type' => 'integer',
        'alias' => 'i',
      ],
    ];
  }

}
