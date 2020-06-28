<?php
function OpenContest($bot, $title, $mibBet, $maxBet, $duration, $options)
{
  $res = $bot->contestCreate(false, $title, $mibBet, $maxBet, $duration, $options);
  $contestId = $res["_id"];
  $res = $bot->contestStart($contestId);

  return $res;
}
