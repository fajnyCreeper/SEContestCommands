<?php
function GetActiveId($bot)
{
  $res = $bot->contestsList();

  if (is_null($res))
    return false;
    
  $contestId = $res["active"]["_id"];

  return $contestId;
}
