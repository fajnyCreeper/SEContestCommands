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
* `args` - arguments that are passed and processed

## Chat commands
Examples are using base command `!bets`
```
!bets start <Bets_title> <Duration> <1st_option> ... <10th_option>
!bets close
!bets draw <Winning_option>
!bets refund
```

### Request on API
This will show example body of StreamElements command
```
${customapi.example.com/main.php?key=my_key&args=${pathescape ${queryescape ${1:|' '}}}}
```
