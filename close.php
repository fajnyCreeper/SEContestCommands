<?php
function CloseContest($bot, $contestId)
{
  $res = $bot->contestClose($contestId);
  
  return $res;
}
