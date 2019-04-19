<?php
/**
 * @file providing the service that will do processing of site api key.
 *
 */

namespace Drupal\site_api\Services;

/**
 * ValidateApiKey Service for validating api key.
 */
class ValidateApiKey
{
  public function __construct() {
  }

  /**
   * Check if API Key is valid.
   */
  public function isValidApiKey($apiKey) {
    $siteConfig = \Drupal::config('system.site');
    $configApiKey = $siteConfig->get('siteapikey') ?? '';
    if ($configApiKey === $apiKey) {
      return TRUE;
    }
    return FALSE;
  }
}