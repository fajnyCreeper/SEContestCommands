<?php
function GetLatestId($channel, $bearer)
{
  $ch = curl_init("https://api.streamelements.com/kappa/v2/contests/".$channel);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'Content-Type: application/json',
    'Authorization: Bearer '.$bearer)
  );
  $result = curl_exec($ch);
  $result_array = json_decode($result, true);
  return $result_array["contests"][0]["_id"];
}

function GetLatestOptions($channel, $bearer)
{
  $ch = curl_init("https://api.streamelements.com/kappa/v2/contests/".$channel);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'Content-Type: application/json',
    'Authorization: Bearer '.$bearer)
  );
  $result = curl_exec($ch);
  $result_array = json_decode($result, true);
  return $result_array["contests"][0]["options"];
}
