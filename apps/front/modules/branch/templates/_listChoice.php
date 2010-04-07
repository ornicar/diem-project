<?php // Vars: $branchPager

echo _link('@project_by_state')->param('state', 'open');

echo 'You are currently browsing documentation for '._tag('strong', $currentBranch->name);
echo ' - Switch to version';

$currentBranchUrl = _link($currentBranch)->getAbsoluteHref();

foreach ($branches as $branch)
{
  if($currentBranch->id !== $branch->id)
  {
    $branchUrl = _link($branch)->getAbsoluteHref();
    
    echo _link(str_replace($currentBranchUrl, $branchUrl, $sf_request->getUri()))->text($branch->number);
  }
}