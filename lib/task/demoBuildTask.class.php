<?php

class demoBuildTask extends dmContextTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', 'front'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev')
    ));
    
    $this->addArguments(array(
      new sfCommandArgument('site-user', sfCommandArgument::REQUIRED, 'The site mysql user'),
      new sfCommandArgument('site-password', sfCommandArgument::REQUIRED, 'The site mysql password'),
      new sfCommandArgument('demo-user', sfCommandArgument::REQUIRED, 'The demo mysql user'),
      new sfCommandArgument('demo-password', sfCommandArgument::REQUIRED, 'The demo mysql password'),
      new sfCommandArgument('site-url', sfCommandArgument::REQUIRED, 'The site url'),
      new sfCommandArgument('demo-url', sfCommandArgument::REQUIRED, 'The demo url')
    ));

    $this->namespace = 'demo';
    $this->name = 'build';
    $this->briefDescription = 'Builds a copy of the site to make an online demo';

    $this->detailedDescription = $this->briefDescription;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $this->filesystem = $this->get('filesystem');

    $this->copySiteToDemo();

    $this->cleanDemoFilesystem();

    $this->clearApcSystemCache($arguments['site-url']);

    $this->configureDemo($arguments['demo-user'], $arguments['demo-password']);

    $this->copyDatabase($arguments['site-user'], $arguments['site-password'], $arguments['demo-user'], $arguments['demo-password']);

    $this->setupDemo();

    $this->prepareDemo($arguments['demo-url']);
  }

  protected function prepareDemo($demoUrl)
  {
    $this->log('Prepare demo');
    $this->exec('cd %demo_dir% && php symfony demo:prepare '.$demoUrl);
  }

  protected function clearApcSystemCache($siteUrl)
  {
    $this->log('Clear apc system cache');

    $fileName = dmString::random(12).'.php';
    $file = sfConfig::get('sf_web_dir').'/cache/'.$fileName;
    file_put_contents($file, '<?php apc_clear_cache();');
    $this->getContext()->get('web_browser')->get(trim($siteUrl, '/').'/cache/'.$fileName);
    unlink($file);
  }

  protected function setupDemo()
  {
    $this->log('Setup demo');
    $this->exec('cd %demo_dir% && php symfony dm:setup');
  }

  protected function copyDatabase($siteUser, $sitePassword, $demoUser, $demoPassword)
  {
    $this->log('Export site database');
    $this->exec('mysqldump -u '.$siteUser.' -p'.$sitePassword.' --opt diem_project > %site_dir%/cache/diem_project.sql');

    $this->log('Import demo database');
    $this->exec('mysql -u '.$demoUser.' -p'.$demoPassword.' diem_demo < %site_dir%/cache/diem_project.sql');
  }

  protected function configureDemo($demoUser, $demoPassword)
  {
    $this->log('configure database');
    file_put_contents($this->getDemoDir().'/config/databases.yml', "all:
  doctrine:
    class: sfDoctrineDatabase
    param:
      dsn: 'mysql://".$demoUser.":".$demoPassword."@localhost/diem_demo'");

    $this->log('configure languages');
    file_put_contents(
      $this->getDemoDir().'/config/dm/config.yml',
      strtr(file_get_contents($this->getDemoDir().'/config/dm/config.yml'), array(
        '[ en ]' => '[en, fr]',
        'apc:                  true' => 'apc: true'
      ))
    );

    $this->log('configure recaptcha keys');
    file_put_contents(
      $this->getDemoDir().'/apps/front/config/app.yml',
      strtr(file_get_contents($this->getDemoDir().'/config/app.yml'), array(
        'public_key:   '.sfConfig::get('app_recaptcha_public_key')  => 'public_key:  '.sfConfig::get('app_demo_recaptcha_public_key'),
        'private_key:  '.sfConfig::get('app_recaptcha_private_key') => 'private_key: '.sfConfig::get('app_demo_recaptcha_private_key')
      ))
    );

    $this->log('add disclaimer');
    $pageFile = $this->getDemoDir().'/apps/front/modules/dmFront/templates/pageSuccess.php';
    file_put_contents($pageFile, str_replace(
      "\$helper->renderArea('layout.top', '.clearfix').",
      "\$helper->renderArea('layout.top', '.clearfix')._tag('div.disclaimer', __('This is a <strong>DEMO</strong> site, reinitialized each day.').' '._link(str_replace('http://demo.', 'http://', \$sf_request->getUri()))->text(__('Go to the official Diem site'))).",
      file_get_contents($pageFile)
    ));

    $this->log('configure admin services');
    file_put_contents(
      $this->getDemoDir().'/apps/admin/config/dm/services.yml',
      strtr(file_get_contents($this->getDemoDir().'/apps/admin/config/dm/services.yml'), array(
        'show_ip:                  true' => 'show_ip:                  false',
        'code_editor.class:          dmAdminCodeEditor' => 'code_editor.class:          dmAdminCodeEditorRestricted'
      ))
    );

    $this->log('Restrict my account change password');
    file_put_contents($this->getDemoDir().'/apps/admin/lib/DmUserAdminMyAccountForm.php', "<?php
class DmUserAdmin"."MyAccountForm extends BaseDmUserAdminMyAccountForm
{

  public function currentUserValidator(\$validator, \$values)
  {
    \$values = parent::currentUserValidator(\$validator, \$values);

    if(\$values['password'] && \$values['password'] !== 'admin')
    {
      throw new sfValidatorErrorSchema(\$validator, array('email' => new sfValidatorError(\$validator, 'You are not allowed to change the password of this demo site.')));
    }

    return \$values;
  }
}");
  }
  
  protected function cleanDemoFilesystem()
  {
    foreach(array('log', 'cache', 'public_html/cache') as $emptyDir)
    {
      $this->log('Empty dir '.$emptyDir);
      $this->exec('rm -rf %demo_dir%/'.$emptyDir.'/*');
    }
  }

  protected function copySiteToDemo()
  {
    $this->log('Copy site to demo');

    $this->exec('rsync -azC --force --delete --exclude-from=%rsync_file% %site_dir%/* %demo_dir%');

    $this->log('Importing file logs');

    $this->filesystem->mkdir($this->getDemoDir().'/data/dm/log');

    $this->exec('cp %site_dir%/data/dm/log/* %demo_dir%/data/dm/log');
  }

  protected function deleteDemo()
  {
    $this->log('Delete demo');
    
    $this->filesystem->mkDir($this->getDemoDir());
    $this->exec('rm -rf %demo_dir%/*');

    $this->exec('mkdir %demo_dir%/logs');
  }

  protected function getDemoDir()
  {
    return realpath(sfConfig::get('sf_root_dir').'/..').'/diem_demo';
  }

  protected function exec($command)
  {
    return parent::exec(strtr($command, array(
      '%demo_dir%'    => $this->getDemoDir(),
      '%site_dir%'    => sfConfig::get('sf_root_dir'),
      '%rsync_file%'  => dirname(__FILE__).'/demo_rsync_exclude.txt'
    )));
  }
}