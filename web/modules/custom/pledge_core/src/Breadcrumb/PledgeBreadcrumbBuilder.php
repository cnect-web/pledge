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
    if (
      !empty($parameters['view_id']) ||
      !empty($parameters['node']) && !empty($parameters['node'])
    ) {
      return TRUE;
    }

    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function build(RouteMatchInterface $route_match) {
    $breadcrumb = new Breadcrumb();

    // Add a link to the homepage as our first crumb.
    $breadcrumb->addLink(Link::createFromRoute('Home', '<front>'));

    // Get the node for the current page
    $node = $route_match->getParameter('node');
    if (!empty($node)) {
      if ($node->bundle() == 'pledge') {
        $breadcrumb->addLink(Link::createFromRoute('Pledges', 'view.pledges.page'));
      }
      elseif ($node->bundle() == 'members') {
        $breadcrumb->addLink(Link::createFromRoute('Members', 'view.pledge_members.page'));
      }

      $breadcrumb->addLink(Link::createFromRoute($node->getTitle(), '<nolink>'));
    }

    $view = $route_match->getParameter('view_id');
    if (!empty($view)) {
      if ($view == 'pledges') {
        $breadcrumb->addLink(Link::createFromRoute('Pledges', '<nolink>'));
      }
      elseif ($view == 'pledge_members') {
        $breadcrumb->addLink(Link::createFromRoute('Members', '<nolink>'));
      }
      elseif ($view == 'pledge_your_pledges') {
        $breadcrumb->addLink(Link::createFromRoute('Your pledges', '<nolink>'));
      }
    }

    // Don't forget to add cache control by a route.
    // Otherwise all pages will have the same breadcrumb.
    $breadcrumb->addCacheContexts(['route']);

    // Return object of type breadcrumb.
    return $breadcrumb;
  }

}