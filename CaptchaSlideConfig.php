<?php namespace ProcessWire;

/**
 * Slide Captcha for ProcessWire
 * This is a test, used to determine, whether the user is human, in order to prevent bot and spam attacks.
 *
 * @author tech-c.net
 * @license Licensed under GNU/GPL v2
 * @link https://tech-c.net/posts/slide-captcha-module-for-processwire/
 * @version 1.0.4
 * 
 * @see Forum Thread: https://processwire.com/talk/topic/30217-slide-captcha-for-processwire/
 * @see Donate: https://tech-c.net/donation/
 */

class CaptchaSlideConfig extends ModuleConfig {
  /**
   * Get default condifguration, automatically passed to input fields.
   * @return array
   */
  public function getDefaults() {
    return array(
      'filename' => 'captcha',
      'tolerance' => 3,
      'logging' => 0,
      'page_include' => 0,
      'page_list' => array(),
    );
  }
  /**
   * Render input fields on config Page.
   * @return string
   */
  public function getInputfields() {
    $fields = parent::getInputfields();

    $field = $this->modules->get('InputfieldText');
    $field->name = 'filename';
    $field->label = __('Filename');
    $field->description = __('Filename which must not exist in the root directory and also not represents a page. The filename must be also changed in the captcha.js. The resolving URL receives the information from the client side JavaScript.');
    $fields->add($field);

    $field = $this->modules->get('InputfieldText');
    $field->name = 'tolerance';
    $field->label = __('Tolerance');
    $field->description = __('Specifies a tolerance in order to offer better user experience. A tolerance of 3 means +- 3 pixel tolerance (3 recommended).');
    $fields->add($field);

    $field = $this->modules->get('InputfieldCheckbox');
    $field->name = 'block_empty_origin';
    $field->label = __('Logging');
    $field->label2 = __('Enable');
    $field->description = __('Logs unsolved and solved Captcha attempts in the ProcessWire system logs.');
    $field->attr('name', 'logging');
    $field->attr('checked', '');
    $fields->add($field);

    $field = $this->modules->get('InputfieldSelect');
    $field->name = 'page_include';
    $field->required = true;
    $field->label = __('Pages');
    $field->description = __('The JavaScript and CSS for the Captcha will be included into the following pages.');
    $field->required = true;
    $field->addOptions(array(
      0 => __('Include in all pages'),
      1 => __('Include only in following pages'),
      2 => __('Exclude in following pages'),
      3 => __('Don\'t include at all')
    ));
    $fields->add($field);

    $field = $this->modules->get('InputfieldPageListSelectMultiple');
    $field->name = 'page_list';
    $field->label = ' ';
    $field->collapsed = Inputfield::collapsedNever;
    $fields->add($field);

    $field = $this->modules->get('InputfieldMarkup');
    $field->value = '<p style="text-align:center">'.__('This module uses photos from:').'<br />';
    $field->value .= '<a target="_blank" href="https://unsplash.com/">unsplash.com</a><br />';
    $field->value .= '</p>';

    $field->value .= '<p style="text-align:center">';
    $field->value .= 'CaptchaSlide @ <a href="https://processwire.com/modules/captcha-slide/">processwire.com</a><br />';
    $field->value .= 'CaptchaSlide @ <a href="https://github.com/techcnet/CaptchaSlide">github.com</a><br />';
    $field->value .= 'CaptchaSlide @ <a href="https://tech-c.net/posts/slide-captcha-module-for-processwire/">tech-c.net</a>';
    $field->value .= '</p>';

    $field->value .= '<p style="text-align:center">';
    $field->value .= '<a target="_blank" href="https://tech-c.net/donation/"><img style="margin:auto;" src="'.wire('config')->urls->siteModules.'CaptchaSlide'.'/donate.png" /></a>';
    $field->value .= '</p>';

    $field->collapsed = Inputfield::collapsedNever;
    $fields->add($field);

    return $fields;
  }
}
