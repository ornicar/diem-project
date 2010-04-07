<?php

/**
 * Plugin form.
 *
 * @package    diem-project
 * @subpackage form
 * @author     Thibault D
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PluginForm extends BasePluginForm
{
  public function configure()
  {
    unset(
      $this['tags_list'],
      $this['package_form'],
      $this['is_active'],
      $this['is_done'],
      $this['bundled_in_core'],
      $this['symfony_url'],
      $this['package_url'],
      $this['created_by'],
      $this['updated_by'],
      $this['svn_url'],
      $this['branches_list']
    );

    $this->widgetSchema['name']->setLabel('Name *');
    $this->widgetSchema->setHelp('name', 'The plugin name must end with "Plugin"');

    $this->widgetSchema['resume']->setLabel('Short description *')->setAttribute('class', 'full_width');
    $this->widgetSchema->setHelp('resume', 'With one phrase, tell what the plugin is for');

    $this->widgetSchema['text']->setLabel('Description')->setAttribute('class', 'full_width')->setAttribute('rows', 3);
    $this->widgetSchema->setHelp('text', 'More precise description that appears on top of the page');

    $this->widgetSchema['readme']->setLabel('Documentation *')->setAttribute('class', 'full_width')->setAttribute('rows', 12);
    $this->widgetSchema->setHelp('readme', 'Usage documentation of the plugin. Markdown is accepted. Do *not* describe the installation, it will be generated automatically.');

    $this->widgetSchema->setHelp('requires_migration', 'Does the plugin have database tables? The installation documentation will be generated depending on your answer.');

    $this->widgetSchema['github_url']->setLabel('GitHub url *')->setAttribute('class', 'full_width');
    $this->widgetSchema->setHelp('github_url', 'The plugin page on github (ex: http://github.com/ornicar/dmGoogleMapPlugin)');

    $this->validatorSchema['name'] = new sfValidatorRegex(array(
      'pattern' => '/^\w{3,}Plugin$/i'
    ));

    $this->validatorSchema['resume']->setOption('required', true);
    $this->validatorSchema['readme']->setOption('required', true);
    $this->validatorSchema['github_url']->setOption('required', true);

    $this->validatorSchema['github_url'] = new sfValidatorRegex(array(
      'required' => true,
      'pattern' => '|^'.preg_quote('http://github.com/', '/').'[^/]+/[^/]+/?$|i'
    ));

    $this->setDefault('github_url', 'http://github.com/');
  }
}