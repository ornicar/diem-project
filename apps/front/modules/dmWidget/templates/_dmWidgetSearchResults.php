<?php
/*
 * Variables available :
 * - $query (string)        the searched query
 * - $form  (mySearchForm)  the search form
 * - $pager (dmSearchPager) the search pager
 */

if (!$pager)
{
  echo _tag('h1.t_big', __('No results for "%1%"', array('%1%' => escape($query))));
}
else
{
  echo _tag('h1.t_big', __('Results %1% to %2% of %3%', array(
    '%1%' => $pager->getFirstIndice(),
    '%2%' => $pager->getLastIndice(),
    '%3%' => $pager->getNbResults()
  )));
}

echo
  $form->open('.big_search_form action=main/search method=get'),
  
  $form['query']->field('.big_search_field'),
  
  $form->submit('Search'),
  
  $form->close()
;

if (!$pager)
{
  return;
}

echo $pager->renderNavigationTop();

echo £o('ol.search_results.clearfix start='.$pager->getFirstIndice());

foreach($pager->getResults() as $result)
{
  echo _tag('li.search_result.clickable.ml20.mb5',
  
    _tag('span.score.mr10', ceil(100*$result->getScore()).'%').
    
    _link($result->getPage())->text(_tag('strong', escape($result->getPage()->name))).
    _tag('span.ml10', dmString::truncate($result->getPageContent(), 200))
  );
}

echo £c('ol');

echo $pager->renderNavigationBottom();