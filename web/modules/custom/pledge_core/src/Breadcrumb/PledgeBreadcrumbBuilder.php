<?php
namespace Drupal\pledge_core\Breadcrumb;

use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Link;

class PledgeBreadcrumbBuilder implements BreadcrumbBuilderInterface{

  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $attributes) {

    $parameters = $attributes->getParameters()->all();
    if (isset($parameters['node']) && !empty($parameters['node'])) {
      return TRUE;
    }

    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function build(RouteMatchInterface $route_match) {
    $breadcrumb = new Breadcrumb();

//    var_dump($route_match->getRawParameters());
//    var_dump($route_match->getRouteObject());
//    exit();

    // Add a link to the homepage as our first crumb.
    $breadcrumb->addLink(Link::createFromRoute('Home', '<front>'));

    // Get the node for the current page
    $node = $route_match->getParameter('node');

    if ($node->bundle() == 'pledge') {
      $breadcrumb->addLink(Link::createFromRoute('Pledges', 'view.pledges.page'));
    }

    $breadcrumb->addLink(Link::createFromRoute($node->getTitle(), '<nolink>'));

    // Don't forget to add cache control by a route.
    // Otherwise all pages will have the same breadcrumb.
    $breadcrumb->addCacheContexts(['route']);

    // Return object of type breadcrumb.
    return $breadcrumb;
  }

}