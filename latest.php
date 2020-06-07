<?php
function GetLatestId($bot)
{
  $res = $bot->contestsList();
  $contestId = $res["contests"][0]["_id"];

  return $contestId;
}

function GetLatestOptions($bot)
{
  $res = $bot->contestsList();
  $options = $res["contests"][0]["options"];
  
  return $options;
}
