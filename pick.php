<?php
function PickWinningOption($channel, $bearer, $contestId, $winnerId)
{
  $data = array(
    "winnerId" => "$winnerId"
  );
  $ch = curl_init("https://api.streamelements.com/kappa/v2/contests/".$channel."/".$contestId."/winner");
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'Content-Type: application/json',
    'Authorization: Bearer '.$bearer)
  );
  $result = curl_exec($ch);

  return $result;
}
