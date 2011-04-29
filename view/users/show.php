<?php
    //$u for user
echo $u->user;
?>


<ul>
<?
foreach($u->groups as $group):
?>
<li>
    <?=$group->name?><br/>
    (<?=$group->min_bet . "-" . $group->max_bet?>)
</li>
<?  endforeach;?>
</ul>
