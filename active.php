<?php
function GetActiveId($bot)
{
  $res = $bot->contestsList();
  $contestId = $res["active"]["_id"];
  return $contestId;
}
