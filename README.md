# SEContestCommands
Chat commands for StreamElements' Contests

## Credentials
* Create file called `credentials.php`
* The file will contain three variables
  * `$key` - random string, that is used in URL
  * `$bearer` SE JWT Token that you can find [here](https://streamelements.com/dashboard/account/channels) (After clicking "Show secrets")


## Request
This will explain all possible variables
* `key` - user generated string from `credentials.php`
* `args` - arguments that are passed and processed

## Chat commands
Examples are using base command `!bets`
```
!bets start <Bets_title> <Duration> <1st_option> ... <10th_option>
!bets close
!bets draw <Winning_option>
!bets refund

!bets advanced start <Bets_title> <Duration> <MinBet> <MaxBet> <1st_option> ... <10th_option>
!bets advanced close <contestId>
!bets advanced draw <contestId> <winnerId>
!bets advanced refund <contestId>
```

### Request on API
This will show example body of StreamElements command
```
${customapi.example.com/main.php?key=my_key&args=${pathescape ${queryescape ${1:|' '}}}}
```
