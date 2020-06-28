<?php
/*
Credentials structure:
$key = "random string";
$bearer = "SE JWT token";
*/
ini_set('html_errors', false);
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

  $args = trim(urldecode($_GET["args"]));
  $argsArray = explode(" ", $args);

  $action = strtolower($argsArray[0]);

  switch($action)
  {
    case "start":
      if (count($argsArray) >= 5)
      {
        $duration = intval($argsArray[2]);
        if ($duration == 0)
          $duration = 15;

        $title = str_replace("_", " ", trim($argsArray[1]));

        $options = array();
        for ($i = 3; $i < count($argsArray); $i++)
        {
          $options[$i - 3] = array("title" => str_replace("_", " ", $argsArray[$i]), "command" => strtolower($argsArray[$i]));
        }

        OpenContest($bot, $title, 1, 10000, $duration, $options);
      }
      else
        echo "Wrong format! Expected !bets start Bets_title duration Option_1 Option_2 ...";
      break;

    case "close":
      CloseContest($bot, GetActiveId($bot));
      break;

    case "draw":
      if (count($argsArray) >= 2)
      {
        $winnerText = "";
        for ($i = 1; $i < count($argsArray); $i++)
        {
          $winnerText .= $argsArray[$i] . " ";
        }
        $winnerText = str_replace(" ", "_", trim(strtolower($winnerText)));

        $latest = GetLatestOptions($bot);
        $winnerId;
        foreach ($latest as $option)
        {
          if ($option["command"] == $winnerText)
            $winnerId = $option["_id"];
        }
        PickWinningOption($bot, GetLatestId($bot), $winnerId);
      }
      else
        echo "Wrong format! Expected !bets draw winningOption";
      break;

    case "refund":
      CloseContest($bot, GetActiveId($bot));
      RefundContest($bot, GetLatestId($bot));
      break;

    case "advanced":
      $advAction = (count($argsArray) >= 2) ? (strtolower($argsArray[1])) : ("");
      switch($advAction)
      {
        case "start":
          if (count($argsArray) >= 8)
          {
            $duration = intval($argsArray[3]);
            if ($duration == 0)
              $duration = 15;

            $minBet = intval($argsArray[4]);
            if ($minBet == 0)
              $minBet = 1;

            $maxBet = intval($argsArray[5]);
            if ($maxBet == 0)
              $maxBet = 10000;

            $title = str_replace("_", " ", trim($argsArray[2]));

            $options = array();
            for ($i = 6; $i < count($argsArray); $i++)
            {
              $options[$i - 6] = array("title" => str_replace("_", " ", $argsArray[$i]), "command" => strtolower($argsArray[$i]));
            }

            OpenContest($bot, $title, $minBet, $maxBet, $duration, $options);
          }
          else
            echo "Wrong format! Expected !bets advanced start Bets_title duration minBet maxBet Option_1 Option_2 ...";
          break;

        case "close":
          if (count($argsArray) >= 3)
          {
            CloseContest($bot, $argsArray[2]);
          }
          else
          {
            echo "Wrong format! Expected !bets advanced close contestId";
          }
          break;

        case "draw":
          if (count($argsArray) >= 4)
          {
            PickWinningOption($bot, $argsArray[2], $argsArray[3]);
          }
          else
          {
            echo "Wrong format! Expected !bets advanced draw contestId winnerId";
          }
          break;

        case "refund":
          if (count($argsArray) >= 3)
          {
            CloseContest($bot, $argsArray[2]);
            RefundContest($bot, $argsArray[2]);
          }
          else
          {
            echo "Wrong format! Expected !bets advanced refund contestId";
          }
          break;

        default:
          echo "Invalid action! Expected: start|close|draw|refund";
          break;
      }
      break;

    default:
      echo "Invalid action! Expected: start|close|draw|refund|advanced";
  }
}
else
{
  echo "Something went wrong!";
}
