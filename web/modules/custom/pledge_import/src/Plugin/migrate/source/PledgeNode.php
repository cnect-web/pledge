<?php

namespace Drupal\pledge_import\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for pledge pledge content.
 *
 * @MigrateSource(
 *   id = "pledge_node"
 * )
 */
class PledgeNode extends SqlBase {

  public function getFields() {
    return [
      'id_pledge' => $this->t('Pledge ID'),
      'organization_name' => $this->t('Organization name'),
      'website' => $this->t('Website'),
      'twitter' => $this->t('Twitter'),
      'logo_filename' => $this->t('Logo'),
      'short_desc' => $this->t('Shor description'),
      'description' => $this->t('Description'),
      'flag_digital_skill_for_all' => $this->t('Digital skills for all citizens'),
      'flag_digital_skill_for_labour' => $this->t('Digital skills for labour force'),
      'flag_ict_professional' => $this->t('Digital skills for ICT professionals'),
      'flag_digital_skill_edu' => $this->t('Digital skills in education'),
      'qualitative_impact' => $this->t('Qualitative impact'),
      'national_scope' => $this->t('National scope'),
      'funding' => $this->t('Funding'),
      'funding_additional_text' => $this->t('Funding additional text'),
      'roadmap_start_date' => $this->t('Roadmap start date'),
      'roadmap_stop_date' => $this->t('Roadmap end date'),
      'contact_name' => $this->t('Contact name'),
      'contact_email' => $this->t('Contact email'),
      'contact_tel' => $this->t('Contact telephone'),
      'passwd' => $this->t('Password'),
      'created' => $this->t('Created'),
      'updated' => $this->t('Updated'),
      'logo_multiorg' => $this->t('Multiple logos'),
    ];
  }

  /**А
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('pledge', 'i')
      ->fields('i', array_keys($this->getFields()));
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = $this->getFields();

    $fields['countries'] = $this->t('Countries');
    $fields['impacts'] = $this->t('Impacts');
    $fields['milestones'] = $this->t('Milestones');
    $fields['organizations'] = $this->t('Organizations');

    return $fields;
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
    // Extract countries.
    $terms = $this->select('pledge_country', 'c')
      ->fields('c', ['id_country'])
      ->condition('id_pledge', $row->getSourceProperty('id_pledge'))
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('countries', $terms);

    // Extract organizations.
    $terms = $this->select('pledge_org', 'o')
      ->fields('o', ['id_org'])
      ->condition('id_pledge', $row->getSourceProperty('id_pledge'))
      ->execute()
      ->fetchCol();
    $row->setSourceProperty('organizations', $terms);

    // Extract impacts.
    $terms = $this->select('pledge_impact', 'i')
      ->fields('i', ['id_impact'])
      ->condition('id_pledge', $row->getSourceProperty('id_pledge'))
      ->execute()
      ->fetchAll();
    var_dump($terms);
    $row->setSourceProperty('impacts', $terms);

    // Extract milestones.
    $terms = $this->select('pledge_milestones', 'm')
      ->fields('m', ['id_milestone'])
      ->condition('id_pledge', $row->getSourceProperty('id_pledge'))
      ->execute()
      ->fetchAll();
    $row->setSourceProperty('milestones', $terms);

    $row->setSourceProperty('roadmap_start_date', date('Y-m-d\TH:i:s', strtotime($row->getSourceProperty('roadmap_start_date'))));
    $row->setSourceProperty('roadmap_stop_date', date('Y-m-d\TH:i:s', strtotime($row->getSourceProperty('roadmap_stop_date'))));

    return parent::prepareRow($row);
  }
}
