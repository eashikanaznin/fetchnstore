<?php

namespace Drupal\job_builder\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\job_builder\Utils\CurlGenerator;
use Drupal\job_builder\Utils\nodeImporter;

/**
 * Configure job_builder settings for this site.
 */
class SettingsForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'job_builder_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['help'] = [
        '#type' => 'markup',
        '#markup' => '<h2>Click to Import apprenticeships in to the Opportunity</h2></br>',

        ];
        $form['actions']['import'] = [
        '#type' => 'submit',
        '#value' => $this->t('Import Now'),
        ];

        //add your code here
        //please add checkbox to delete previous record

        return $form;
    }

    /**
     * Implements a form submit handler.
     *
     * @param array $form
     *   The render array of the currently built form.
     *
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   Object describing the current state of the form.
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        $action = $form_state->getValue('import');

        /**
         * Curl request to adv API and imports to opportunity content type
        */
        $api_response = CurlGenerator::curlReq();

        //returns number of record created
        $count = nodeImporter::nodeGenerator($api_response);

        if ($count) {
            \Drupal::messenger()->addMessage($count.' Imported successfully');
        }

    }

}
