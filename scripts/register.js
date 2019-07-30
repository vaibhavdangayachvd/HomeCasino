function check(){
	var nm=/^[a-z A-Z]{3,15}$/;
	var un=/^[a-z A-Z 0-9]{3,30}$/;
	var pw=/^[a-z A-Z 0-9 @ -]{3,30}$/;
	var em=/^[a-z A-Z 0-9]{3,25}@[a-z]{4,10}\.[a-z]{2,5}$/;
	var ph=/^[1-9]{1}[0-9]{9}$/;
	if (document.registration.first.value==""){
		document.registration.first.focus();
		return false;
	}
	else if (nm.test(document.registration.first.value)==false){
		alert('First Name should only contain a-z size 3-15')
		document.registration.first.focus();
		return false;
	}
	else if(document.registration.last.value==""){
		document.registration.last.focus();
		return false;
	}
	else if (nm.test(document.registration.last.value)==false){
		alert('Last Name should only contain a-z size 3-15')
		document.registration.last.focus();
		return false;
	}
	else if(document.registration.username.value==""){
		document.registration.username.focus();
		return false;
	}
	else if (un.test(document.registration.username.value)==false){
		alert('Username should only contain a-z A-Z 0-9 size 3-30')
		document.registration.username.focus();
		return false;
	}
	else if(document.registration.password.value==""){
		document.registration.password.focus();
		return false;
	}
	else if (pw.test(document.registration.password.value)==false){
		alert('Password should only contain a-z A-Z 0-9 size 3-30')
		document.registration.password.focus();
		return false;
	}
	else if(document.registration.rpassword.value==""){
		document.registration.rpassword.focus();
		return false;
	}
	else if (pw.test(document.registration.rpassword.value)==false){
		alert('Password should only contain a-z A-Z 0-9 size 3-30')
		document.registration.rpassword.focus();
		return false;
	}
	else if(document.registration.password.value!=document.registration.rpassword.value)
	{
		document.registration.rpassword.value="";
		alert('Passwords Do Not Match');
		document.registration.rpassword.focus();
		return false;
	}
	else if(document.registration.email.value==""){
		document.registration.email.focus();
		return false;
	}
	else if(em.test(document.registration.email.value)==false){
		alert('Incorrect Email');
		document.registration.email.focus();
		return false;
	}
	else if(document.registration.phone.value==""){
		document.registration.phone.focus();
		return false;
	}
	else if(ph.test(document.registration.phone.value)==false){
		alert('Phone number should be of 10 digit not starting from 0');
		document.registration.phone.focus();
		return false;
	}
	else if(document.registration.gender.value==""){
		alert('Gender is Mendatory');
		return false;
	}
	else
		return true;
}