# SEContestCommands
Chat commands for StreamElements' Contests

## Credentials
* Create file called `credentials.php`
* The file will contain three variables
  * `$key` - random string, that is used in URL
  * `$channel` SE Account ID that you can find [here](https://streamelements.com/dashboard/account/channels)
  * `$bearer` SE JWT Token that you can find [here](https://streamelements.com/dashboard/account/channels) (After clicking "Show secrets")


## Request
This will explain all possible variables
* `key` - user generated string from
* `action` - action, that the API should do (start, close, draw bets)
* `name` - name of bets (used with action _"start"_)
* `duration` - duration of bets in minutes (used with action _"start"_)
* `options` - options to bet, separated by space (underscore used as space)  (used with action _"start"_)
* `winner` winning option (used with action _"draw"_)

## Chat commands
Examples are using base command `!bets`
```
!bets start <Bets_title> <Duration> <1st_option> ... <10th_option>
!bets close
!bets draw <Winning_option>
```

### Request on API
This will show example body of StreamElements command
```
${customapi.example.com/SEContestChatCommands.php?key=my_key&action=${pathescape ${1}}&name=${pathescape ${queryescape ${2|' '}}}&duration=${pathescape ${queryescape ${3|' '}}}&options=${pathescape ${queryescape ${4:|' '}}}&winner=${pathescape ${queryescape ${2:|' '}}}}
```
