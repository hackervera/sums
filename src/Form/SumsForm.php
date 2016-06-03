<?php
namespace Drupal\sums\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Contribute form.
 */
class SumsForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'sums_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form["number1"] = [
      "#type" => 'textfield',
      "#title" => t('First number')
    ];
    $form["number2"] = [
      "#type" => 'textfield',
      "#title" => t('Second number')
    ];
    $form["submit"] = [
      "#type" => 'submit',
      "#value" => t('Submit')
    ];
    
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if(!is_numeric($form_state->getValue('number1'))){
      $form_state->setErrorByName('number1', $this->t('First number is not numeric'));
    }
    if(!is_numeric($form_state->getValue('number2'))){
      $form_state->setErrorByName('number2', $this->t('Second number is not numeric'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $sum = 0;
    foreach ($form_state->getValues() as $key => $value) {
      $sum += intval((string)$value);
    }
    drupal_set_message("Sum is $sum");
  }
}
