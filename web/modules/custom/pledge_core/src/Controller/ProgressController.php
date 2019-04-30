<?php

namespace Drupal\pledge_core\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Front page controller.
 */
class ProgressController extends ControllerBase {

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

  public function progress($node) {
    $user = User::load(\Drupal::currentUser()->id());
    if (!$node->access('update', $user)) {
      throw new AccessDeniedHttpException();
    }

    return $this->entityFormBuilder()->getForm($node, 'progress');
  }


}
