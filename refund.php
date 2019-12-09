<?php
function RefundContest($channel, $bearer, $contestId)
{
  $ch = curl_init("https://api.streamelements.com/kappa/v2/contests/".$channel."/".$contestId."/refund");
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'Content-Type: application/json',
    'Authorization: Bearer '.$bearer)
  );
  $result = curl_exec($ch);

  return $result;
}
