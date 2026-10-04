<?php

namespace Drupal\palindrome_checker\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a small palindrome checking form.
 */
class PalindromeForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'palindrome_checker_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['intro'] = [
      '#markup' => '<p>' . $this->t('A palindrome reads the same forwards and backwards, like level or racecar.') . '</p>',
    ];
    $form['text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Word or phrase'),
      '#description' => $this->t('Spaces, punctuation and capital letters are ignored. Try: A man, a plan, a canal: Panama!'),
      '#required' => TRUE,
      '#maxlength' => 255,
    ];
    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Check'),
    ];
    if ($form_state->has('result')) {
      $form['result'] = [
        '#type' => 'container',
        '#attributes' => ['role' => 'status'],
        'heading' => ['#markup' => '<h2>' . $this->t('Result') . '</h2>'],
        'message' => ['#markup' => '<p>' . $form_state->get('result') . '</p>'],
      ];
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $text = $this->normalize((string) $form_state->getValue('text'));
    if ($text === '') {
      $form_state->setErrorByName('text', $this->t('Enter at least one letter or number.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $original = (string) $form_state->getValue('text');
    $text = $this->normalize($original);
    // Split into Unicode characters so accented letters are not broken apart.
    $letters = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
    $reversed = implode('', array_reverse($letters));
    $result = $text === $reversed
      ? $this->t('“@text” is a palindrome.', ['@text' => $original])
      : $this->t('“@text” is not a palindrome.', ['@text' => $original]);
    $form_state->set('result', $result);
    $form_state->setRebuild(TRUE);
  }

  /**
   * Keeps letters and numbers and converts them to lowercase.
   */
  private function normalize(string $text): string {
    $text = \Normalizer::normalize($text, \Normalizer::FORM_C);
    return preg_replace('/[^\p{L}\p{N}]/u', '', mb_strtolower($text, 'UTF-8'));
  }

}
