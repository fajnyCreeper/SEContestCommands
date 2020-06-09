<?php
function GetActiveId($bot)
{
  $res = $bot->contestsList();

  if (is_null($res) || is_null($res["active"]))
    return false;
    
  $contestId = $res["active"]["_id"];

  return $contestId;
}
