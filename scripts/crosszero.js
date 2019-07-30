let player="X";
let cpu=false;
function start_game(type){
	let obj=document.getElementsByClassName('cell');
	for(let i = 0; i < obj.length; i++){
		obj[i].value=" ";
		obj[i].hidden=false;
		obj[i].disabled=false;
		obj[i].style="";
	}
	if(type)
		cpu=true;
	else
		cpu=false;
	player="X";
	document.czero.single.disabled=true;
	document.czero.cpu.disabled=true;
}
function move(pos){
	let obj=document.getElementsByName(pos);
	if(obj[0].value == "X" || obj[0].value == "O")
		return;
	obj[0].value=player;
	if(check_win()){
		clear_board();
		return;
	}
	if(check_draw()){
		clear_board();
		return;
	}
	if(cpu)
		move_cpu();
	else{
		if(player=="X")
			player="O";
		else
			player="X";
	}
}
function move_cpu(){
	let obj=document.getElementsByClassName('cell');
	while(true){
		let rand=Math.floor((Math.random() * 8) + 1);
		if(obj[rand].value==" ")
		{
			obj[rand].value="O";
			break;
		}
	}
	if(check_win()){
		clear_board();
		return;
	}
	if(check_draw()){
		clear_board();
		return;
	}
}
function check_win(){
	let obj=document.getElementsByClassName('cell');
	for(let i=0;i<7;i+=3){
		if(i==0){//for vertical
			for(let j=0;j<3;++j){
				if(obj[j].value==obj[j+3].value && obj[j].value==obj[j+6].value && obj[j].value != " "){
					obj[j].style=" text-decoration: line-through;"
					obj[j+3].style=" text-decoration: line-through;"
					obj[i+6].style=" text-decoration: line-through;"
					return true;
				}
			}
		}
		if(obj[i].value==obj[i+1].value && obj[i].value==obj[i+2].value && obj[i].value!=" "){//for horizontal
			obj[i].style=" text-decoration: line-through;"
			obj[i+1].style=" text-decoration: line-through;"
			obj[i+2].style=" text-decoration: line-through;"
			return true;
		}
	}
	if(obj[0].value==obj[4].value && obj[4].value==obj[8].value && obj[4].value!=" "){//for diagonals
		obj[0].style=" text-decoration: line-through;"
		obj[4].style=" text-decoration: line-through;"
		obj[8].style=" text-decoration: line-through;"
		return true;
	}
	if(obj[6].value==obj[4].value && obj[4].value==obj[2].value && obj[4].value!=" ") {
		obj[6].style=" text-decoration: line-through;"
		obj[4].style=" text-decoration: line-through;"
		obj[2].style=" text-decoration: line-through;"
		return true;
	}
	return false;
}
function check_draw(){
	let obj=document.getElementsByClassName('cell');
	for(let i = 0; i < obj.length; i++){
		if(obj[i].value==" ")
			return false;
	}
	return true;
}
function clear_board(){
	let obj=document.getElementsByClassName('cell');
	for(let i = 0; i < obj.length; i++){
		obj[i].disabled=true;
		document.czero.single.disabled=false;
		document.czero.cpu.disabled=false;
	}
}