<?php

namespace Drupal\cookiebot_ignore\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class CookiebotIgnoreSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'cookiebot_ignore_settings_form';
  }

  protected function getEditableConfigNames()
  {
    return [
      'cookiebot_ignore.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Form constructor.
    $form = parent::buildForm($form, $form_state);
    // Default settings.
    $config = $this->config('cookiebot_ignore.settings');

    // Source text field.
    $form['ignore'] = [
      '#type' => 'textarea',
      '#title' => $this->t('JavaScript libraries to ignore:'),
      '#placeholder' => "core\ntoolbar",
      '#default_value' => $config->get('cookiebot_ignore.ignore') ? $config->get('cookiebot_ignore.ignore') : '',
      '#description' => $this->t('Write one library per line. Please note: libraries listed here will not be blocked by Cookiebot!'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('cookiebot_ignore.settings');
    $config->set('cookiebot_ignore.ignore', $form_state->getValue('ignore'));
    $config->save();
    parent::submitForm($form, $form_state);
  }
}
