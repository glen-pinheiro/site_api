<?php

namespace Drupal\site_api\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;


class SiteInfoForm extends SiteInformationForm {

   /**
   * {@inheritdoc}
   */
	public function buildForm(array $form, FormStateInterface $form_state) {
    $siteConfig = $this->config('system.site');

    $form =  parent::buildForm($form, $form_state);
		$form['site_information']['siteapikey'] = [
			'#type' => 'textfield',
			'#title' => t('Site API Key'),
			'#default_value' => $siteConfig->get('siteapikey') ?: 'No API Key yet',
			'#description' => t("Please provide Site API Key."),
		];
	
		return $form;
	}

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('system.site')
      ->set('siteapikey', $form_state->getValue('siteapikey'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}