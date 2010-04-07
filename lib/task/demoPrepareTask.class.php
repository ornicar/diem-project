<?php

class demoPrepareTask extends dmContextTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', 'front'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev')
    ));

    $this->addArguments(array(
      new sfCommandArgument('demo-url', sfCommandArgument::REQUIRED, 'The demo url')
    ));
    
    $this->namespace = 'demo';
    $this->name = 'prepare';
    $this->briefDescription = 'Prepares the demo site';

    $this->detailedDescription = $this->briefDescription;
  }

  protected function execute($arguments = array(), $options = array())
  {
    $this->withDatabase();

    if(basename(sfConfig::get('sf_root_dir')) !== 'diem_demo')
    {
      throw new dmException('Can only be used on diem_demo website');
    }

    $this->disableSearchBots();

    $this->renameSite();

    $this->createAdminUser();

    $this->addStyle();

    $this->addHtAccess();

    $this->removeContacts();

    $this->removeInactiveDocumentations();

    $this->exec('php symfony dm:sync-pages');

    $this->exec('php symfony dm:search-update');

    $this->exec('php symfony dm:sitemap-update '.$arguments['demo-url']);
  }

  protected function removeInactiveDocumentations()
  {
    foreach(dmDb::query('DocPage p')->withI18n('en')->fetchRecords() as $docPage)
    {
      if(!$docPage->isActive)
      {
        $docPage->delete();
      }
    }
  }

  protected function removeContacts()
  {
    dmDb::query('DmContact c')->delete()->execute();
  }

  protected function disableSearchBots()
  {
    dmConfig::set('site_indexable', false);
  }

  protected function addStyle()
  {
    $file = sfConfig::get('sf_web_dir').'/theme/css/main.css';
    file_put_contents($file, file_get_contents($file)."\n\n".'
.t_site em, a.t_site em {
  font-size: 20px;
  color: green;
  margin-left:165px;
}
div.disclaimer {
  text-align: center;
  padding: 10px;
  background: #EEDA7B;
  font-size: 120%;
}');
  }

  protected function createAdminUser()
  {
    dmDb::query('DmUser u')->delete()->where('u.username = ?', 'admin')->execute();

    $user = dmDb::table('DmUser')->create(array(
      'username' => 'admin',
      'email'    => 'demo@nomail.org',
      'is_active' => true,
      'is_super_admin' => false
    ));

    $user->setPassword('admin');

    $user->addGroupByName('demo');

    $user->save();
  }

  protected function renameSite()
  {
    $siteName = 'Diem demo';

    $this->log('Rename site to '.$siteName);

    dmConfig::set('site_name', $siteName);

    foreach(dmDb::table('DmLayout')->findAll() as $layout)
    {
      $widget = $layout->getArea('top')->Zones[0]->Widgets[0];
      $values = $widget->values;

      if('Diem' == dmArray::get($values, 'text'))
      {
        $values['text'] = 'Diem <em>demo</em>';

        $widget->values = $values;

        $widget->save();
      }
    }
  }

  protected function addHtAccess()
  {
    file_put_contents(sfConfig::get('sf_web_dir').'/.htaccess', 'Options +FollowSymLinks +ExecCGI

# Add expiration dates to static content
# sudo a2enmod expires && sudo apache2ctl restart
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType image/gif "access plus 30 days"
  ExpiresByType image/png "access plus 30 days"
  ExpiresByType image/jpg "access plus 30 days"
  ExpiresByType image/jpeg "access plus 30 days"
  ExpiresByType image/png "access plus 30 days"
  ExpiresByType image/x-icon "access plus 30 days"
  ExpiresByType text/css "access plus 30 days"
  ExpiresByType text/javascript "access plus 30 days"
  ExpiresByType application/x-Shockwave-Flash "access plus 30 days"
</IfModule>

<IfModule mod_rewrite.c>

  # SEND GZIPPED CONTENT TO COMPATIBLE BROWSERS
  RemoveType .gz
  RemoveOutputFilter .css .js
  AddEncoding x-gzip .gz
  AddType "text/css;charset=utf-8" .css
  AddType "text/javascript;charset=utf-8" .js
  RewriteCond %{HTTP:Accept-Encoding} gzip
  RewriteCond %{REQUEST_FILENAME}.gz -f
  RewriteRule ^(.*)$ $1.gz [L,QSA]
  # END GZIPPED CONTENT

  RewriteEngine On

  RewriteCond %{HTTP_HOST} !^demo\.diem-project\.org$ [NC]
  RewriteRule ^(.*)$ http://demo.diem-project.org/$1 [R=301,L]

  # uncomment the following line, if you are having trouble
  # getting no_script_name to work
  #RewriteBase /

  #RewriteRule ^(.+)/$ $1 [R=301,L]

  # we skip all files with .something
  RewriteCond %{REQUEST_URI} \..+$
  #RewriteCond %{REQUEST_URI} !\.html$
  RewriteRule .* - [L]

  # we check if the .html version is here (caching)
  #RewriteRule ^$ index.html [QSA]
  #RewriteRule ^([^.]+)$ $1.html [QSA]
  #RewriteCond %{REQUEST_FILENAME} !-f

  # no, so we redirect to our front web controller
  RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>');
  }
}