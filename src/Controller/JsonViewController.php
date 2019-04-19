<?php
/**
 * @file
 * Contains \Drupal\site_api\Controller\JsonViewController.
 */

namespace Drupal\site_api\Controller;

use Drupal\Core\Controller\ControllerBase;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\node\Entity\Node;
use Drupal\site_api\Services\ValidateApiKey;

/**
 * Controller routines for site_api routes.
 */
class JsonViewController extends ControllerBase {

  /**
   * Callback for `jsonview/{siteapikey}/{node}` API method.
   */
  public function getPageJson(Request $request) {
    $apiKey = $request->get('siteapikey');
    $nid = $request->get('node');

    $serviceApi = \Drupal::service('site_api.validate_api_key');
    if (!$serviceApi->isValidApiKey($apiKey)) {
      throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
    }

    $node = Node::load($nid);

    $title = $node->get('title')->value;
    $body = $node->get('body')->value;

    $response['nid'] = $nid;
    $response['title'] = $title;
    $response['body'] = $body;

    return new JsonResponse($response);
  }
}

