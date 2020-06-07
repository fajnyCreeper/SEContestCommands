<?php
function RefundContest($bot, $contestId)
{
  $res = $bot->contestRefund($contestId);

  return $res;
}
