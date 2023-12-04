<?php namespace ProcessWire;

/**
 * Captcha Slide for ProcessWire
 * ...
 *
 * @author tech-c.net
 * @license Licensed under GNU/GPL v2
 * @link https://tech-c.net/posts/...
 * @version 1.0.0
 * 
 * @see Forum Thread: 
 * @see https://tech-c.net/donation/
 */

class CaptchaSlideConfig extends ModuleConfig {
  /**
   * Get default condifguration, automatically passed to input fields.
   * @return array
   */
  public function getDefaults() {
    return array(
      'virtual_captcha' => 'captcha',
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
    $field->name = 'virtual_captcha';
    $field->label = __('Virtual captcha');
    $field->description = __('...');
    $fields->add($field);

    $field = $this->modules->get('InputfieldCheckbox');
    $field->name = 'block_empty_origin';
    $field->label = __('Enable logging');
    $field->label2 = __('Enable');
    $field->description = __('...');
    $field->attr('name', 'logging');
    $field->attr('checked', '');
    $fields->add($field);

    $field = $this->modules->get('InputfieldSelect');
    $field->name = 'page_include';
    $field->required = true;
    $field->label = __('Pages');
    $field->description = __('Hide or show the widget on the pages listed below.');
    $field->required = true;
    $field->addOptions(array(
      0 => __('Add to all pages'),
      1 => __('Include only in following pages'),
      2 => __('Exclude following pages'),
      3 => __('Don\'t add')
    ));
    //$field->value = $data['page_include'];
    $fields->add($field);

    $field = $this->modules->get('InputfieldPageListSelectMultiple');
    $field->name = 'page_list';
    $field->label = ' ';
    //$field->attr('value', $data['page_list']);
    $field->collapsed = Inputfield::collapsedNever;
    $fields->add($field);

    $field = $this->modules->get('InputfieldMarkup');
    $field->value = '<p style="text-align:center">'.__('This module uses:').' <a target="_blank" href="https://www.ip2location.com/">IP2Location</a>, <a target="_blank" href="http://github.com/asvd/dragscroll">dragscroll</a> and <a target="_blank" href="https://github.com/donatj/PhpUserAgent">PhpUserAgent</a>.</p>
    <p style="text-align:center">DownloadProtection @ <a href="https://modules.processwire.com/modules/process-page-view-stat/">processwire.com</a><br>
    DownloadProtection @ <a href="https://github.com/techcnet/DownloadProtection">github.com</a><br>
    DownloadProtection @ <a href="https://tech-c.net/posts/page-view-statistic-for-processwire/">tech-c.net</a>
    </p>
    <a target="_blank" href="https://tech-c.net/donation/"><img style="margin:auto;" src="'.wire('config')->urls->siteModules.'DownloadProtection'.'/images/donate.png" /></a>';
    $field->collapsed = Inputfield::collapsedNever;
    $fields->add($field);
// End
    return $fields;
  }
}