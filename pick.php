<?php
function PickWinningOption($bot, $contestId, $winnerId)
{
  $res = $bot->contestDraw($contestId, $winnerId);

  return $res;
}
