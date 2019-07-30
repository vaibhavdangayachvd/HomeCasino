function increase_bet(bet_amt){
	let curr_bet=parseInt(document.betting.bet.value);
	let curr_bal=parseInt(document.betting.balance.value);
	if(curr_bal>=bet_amt)
	{
		document.betting.bet.value=curr_bet+=bet_amt;
		document.betting.notification.value="";
		document.betting.balance.value-=bet_amt;
	}
	else
		document.betting.notification.value="You don't have enough coin balance.";
	document.betting.result.value="";
}
function reset_bet(){
	let curr_bet=parseInt(document.betting.bet.value);
	let curr_bal=parseInt(document.betting.balance.value);
	document.betting.balance.value=curr_bet+curr_bal;
	document.betting.bet.value=0;
	document.betting.notification.value="";
	document.betting.result.value="";
}
function check()
{
	if(document.betting.bet.value==0)
	{
		document.betting.notification.value="Please set the bet first.";
		return false;
	}
	document.betting.bet.disabled=false;
	return true;
}