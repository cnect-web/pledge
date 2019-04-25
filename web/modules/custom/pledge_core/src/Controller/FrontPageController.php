<?php

namespace Drupal\pledge_core\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Front page controller.
 */
class FrontPageController extends ControllerBase {

  /**
   * ContentController constructor.
   */
  public function __construct() {

  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(

    );
  }

  public function front() {
    $output = '<div class="page  page-home">';

    $output .= '<div class="row" id="home-about">';
    $output .= '<div class="col-xs-12 col-sm-9">';
    $output .= $this->getMainContent();
    $output .= '</div>';
    $output .= '<div class="col-xs-12 col-sm-3 numbers">';
    $output .= $this->getSearchForm();
    $output .= '</div>';
    $output .= '</div>';

    $output .= '<div class="row" id="home-blocks">';
    $output .= $this->getCallToAction();
    $output .= '</div>';


    $output .= '<div class="row" id="home-updates">';
    $output .= '<div class="col-sm-6 last-updates">';
    $output .= $this->getLatestItems();
    $output .= '</div>';
    $output .= '<div class="col-sm-offset-2 col-sm-4">';
    $output .= $this->getTwitterBlock();
    $output .= '</div>';
    $output .= '</div>';

    $output .= '</div>';

    return [
      '#theme' => 'markup',
      '#markup' => $output
    ];
  }

  public function getCallToAction() {
    $items = [
      [
        'title' => $this->t('Digital skills for ICT professionals'),
        'description' => $this->t('Developing high level digital skills for ICT professionals in all industry sectors.'),
        'class' => 'bl-bl1',
        'icon' => 'laptop',
        'parameter' => 'field_pledge_ds_ict_professional_value',
      ],
      [
        'title' => $this->t('Digital skills in education'),
        'description' => $this->t('Transforming teaching and learning of digital skills in a lifelong learning perspective, including the training of teachers'),
        'class' => 'bl-bl2',
        'icon' => 'graduation-cap',
        'parameter' => 'field_pledge_ds_in_education_value',
      ],
      [
        'title' => $this->t('Digital skills for labour force'),
        'description' => $this->t('Developing digital skills for the digital economy, e.g. upskilling and reskilling workers, jobseekers; actions on career advice and guidance.'),
        'class' => 'bl-bl3',
        'icon' => 'male',
        'parameter' => 'field_pledge_ds_for_labour_value',
      ],
      [
        'title' => $this->t('Digital skills for all citizens'),
        'description' => $this->t('Developing digital skills to enable all citizens to be active in our digital society.'),
        'class' => 'bl-bl4',
        'icon' => 'building',
        'parameter' => 'field_pledge_ds_for_all_citizens_value',
      ],
    ];

    $output = '<div class="row" id="home-blocks">';
    foreach ($items as $item) {
      $url = Url::fromRoute('view.pledges.page', [
        $item['parameter'] => 1
      ])->toString();
      $output .= "<div class=\"col-sm-6 col-md-3\">
                <div class=\"bl-bl {$item['class']}\">
                    <i class=\"fa fa-{$item['icon']} fa-3x\" aria-hidden=\"true\"></i>
                    <h3><a href=\"$url\">{$item['title']}</a></h3>
                    <p>{$item['description']}</p>
                </div>
            </div>";
    }
    $output .= '</div>';

    return $output;
  }

  protected function getMainContent() {
    // TODO: Move to config / block
    return '<h2>Welcome to the Pledge Viewer</h2>
            <div class="h2-border"></div>
            
            <p>This website collects information about the progress of the pledges 
                in the context of the
    <a target="_blank" href="https://ec.europa.eu/digital-single-market/en/digital-skills-jobs-coalition">Digital Skills and Jobs Coalition</a>.</p>
            
            <p>The Digital Skills and Jobs Coalition brings together Member 
                States, companies, social partners, non-profit organisations
    and education providers who take action to tackle the lack of 
                digital skills in Europe.</p>
            
            <p>Member States can support cooperation among different actors in 
                their country by bringing them together in national Digital 
                Skills and Jobs Coalitions. Find the list of active national 
                coalitions with correspondent contact details
    <a target="_blank" href="https://ec.europa.eu/digital-single-market/en/digital-skills-jobs-coalition">here</a>.</p>
            
            <p>For more information see the <a href="/about">
      about page</a>. For additional information, please use the
                    <a href="/contact">contact page</a>.</p>';
  }

  protected function getSearchForm() {
    return '';
  }

  protected function getTwitterBlock() {
    return $this->getBlock('twitter_block', [
      'tweet_limit' => '3',
      'username' => 'DigitalSkillsEU',
    ]);
  }

  protected function getLatestItems() {
    $view = \Drupal\views\Views::getView('latest_update');
    // Set the display machine id.
    $view->setDisplay('block');

    // Render.
    $render = $view->render();

    $title = [
      '#markup' => '<h2>' . $view->getTitle() . '</h2>',
    ];

    // render(views_embed_view('latest_update', 'block'));
    return  render($title) . render($render);
  }

  protected function getBlock($id, $config = []) {
    $block_manager = \Drupal::service('plugin.manager.block');
    $plugin_block = $block_manager->createInstance($id, $config);
    $render = $plugin_block->build();

    return render($render);
  }

}
