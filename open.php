<?php
function OpenContest($bot, $title, $duration, $options)
{
  $res = $bot->contestCreate(false, $title, 1, 10000, $duration, $options);
  $contestId = $res["_id"];
  $res = $bot->contestStart($contestId);

  return $res;
}
