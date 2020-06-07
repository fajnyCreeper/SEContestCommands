<?php
/*
Credentials structure:
$key = "random string";
$channel = "SE channelID";
$bearer = "SE JWT token";
*/
require_once("credentials.php");

if (isset($_GET["key"], $_GET["args"]) && $_GET["key"] == $key)
{
  require_once("vendor/autoload.php");
  require_once("StreamElements.php");

  $bot = new StreamElements($bearer, "Bearer");

  require_once("open.php");
  require_once("active.php");
  require_once("close.php");
  require_once("latest.php");
  require_once("pick.php");
  require_once("refund.php");

  $args = urldecode($_GET["args"]);
  $argsArray = explode(" ", $args);

  $action = strtolower($argsArray[0]);

  switch($action)
  {
    case "start":
      if (count($argsArray) >= 5)
      {
        $duration = 10;
        try
        {
          $duration = intval($argsArray[2]);
        }
        catch (Exception $e)
        {
          $duration = 15;
        }

        $title = str_replace("_", " ", trim($argsArray[1]));

        $options = array();
        for ($i = 3; $i < count($argsArray); $i++)
        {
          $options[$i - 3] = array("title" => str_replace("_", " ", $argsArray[$i]), "command" => strtolower($argsArray[$i]));
        }

        OpenContest($bot, $title, $duration, $options);
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