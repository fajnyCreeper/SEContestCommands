<?php
/*
Credentials structure:
$key = "random string";
$channel = "SE channelID";
$bearer = "SE JWT token";
*/
require_once("credentials.php");

if (isset($_GET["key"], $_GET["action"]) && $_GET["key"] == $key)
{
  require_once("vendor/autoload.php");

  require_once("open.php");
  require_once("active.php");
  require_once("close.php");
  require_once("latest.php");
  require_once("pick.php");
  require_once("refund.php");

  switch(strtolower($_GET["action"]))
  {
    case "start":
      if (isset($_GET["name"], $_GET["duration"], $_GET["options"]) && trim($_GET["name"]) != "" && trim($_GET["duration"]) != "" && trim($_GET["options"]) != "")
      {
        $duration = 10;
        try
        {
          $duration = intval($_GET["duration"]);
        }
        catch (\Exception $e)
        {
          $duration = 15;
        }

        $name = str_replace("_", " ", trim(urldecode($_GET["name"])));
        $optionsRaw = preg_split('/ /', trim(urldecode($_GET["options"])));
        $options = array();
        foreach($optionsRaw as $key => $value)
        {
          $options[$key] = array("title" => str_replace("_", " ", $value), "command" => strtolower($value));
        }
        unset($value);

        $data = array(
          "botResponses" => false,
          "title" => "$name",
          "minBet" => 10,
          "maxBet" => 10000,
          "duration" => $duration,
          "options" => $options
        );

        OpenContest($channel, $bearer, $data);
      }
      else
        echo "Wrong format! Expected !bets start Bets_title duration Option_1 Option_2 ...";
      break;

    case "close":
      CloseContest($channel, $bearer, GetActiveId($channel, $bearer));
      break;

    case "draw":
      if (isset($_GET["winner"]) && trim($_GET["winner"]) != "")
      {
        $winnerText = str_replace(" ", "_", trim(strtolower($_GET["winner"])));
        $latest = GetLatestOptions($channel, $bearer);
        $winnerId;
        foreach ($latest as $option)
        {
          if ($option["command"] == $winnerText)
            $winnerId = $option["_id"];
        }
        PickWinningOption($channel, $bearer, GetLatestId($channel, $bearer), $winnerId);
      }
      else
        echo "Wrong format! Expected !bets draw winningOption";
      break;

    case "refund":
      RefundContest($channel, $bearer, GetLatestId($channel, $bearer));
      break;

    default:
      echo "Invalid action! Expected: start|close|draw|refund";
  }
}
else
{
  echo "Something went wrong!";
}
