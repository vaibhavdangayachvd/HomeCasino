function check(){
	if(document.logging.user.value == ""){
		document.logging.user.focus();
		return false;
	}
	else if(document.logging.password.value == ""){
		document.logging.password.focus();
		return false;
	}
	else
		return true;
}