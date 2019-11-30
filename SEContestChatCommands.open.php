<?php
function OpenContest($channel, $bearer, $data)
{
  /*$data = array(
    "botResponses" => false,
    "title" => "Test",
    "minBet" => 10,
    "maxBet" => 10000,
    "duration" => 15,
    "options" => array(
      array(
        "title" => "AAA",
        "command" => "aaa"
      ),
      array(
        "title" => "BBB",
        "command" => "bbb"
      )
    )
  );*/
  $ch = curl_init("https://api.streamelements.com/kappa/v2/contests/".$channel);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'Content-Type: application/json',
    'Authorization: Bearer '.$bearer)
  );
  $result = curl_exec($ch);
  $result_array = json_decode($result, true);
  $contestId = $result_array["_id"];



  $ch = curl_init("https://api.streamelements.com/kappa/v2/contests/".$channel."/".$contestId."/start");
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'Content-Type: application/json',
    'Authorization: Bearer '.$bearer)
  );
  $result = curl_exec($ch);

  return $result;
}
