function notifier(msg,note_type='info',_time_lapse=7000,notifier_position_class='notifier_top_right'){
	if(note_type=='error') note_type='danger';
	var notifier_element=document.getElementById('notifier_element');
	var notifier_class='notifier_alert notifier_alert-';
	if(!notifier_element){
		notifier_element=document.createElement('div');
		notifier_element.id='notifier_element';
		notifier_element.style.display='block';
		//notifier_element.style.overflowY='scroll';
		notifier_element.innerHTML="<div style='display:block;' class='notifier_alert'> <span style='background:red;color:white;float:right;padding:0px 4px;border-radius:20px;margin-bottom:10px;cursor:pointer;' onclick='notifier_element.remove()'>&times;</span></div>";
		document.getElementsByTagName('body')[0].appendChild(notifier_element);
	}
	notifier_class+=note_type;
	notifier_element.setAttribute('class',notifier_position_class);
	let msg_element=document.createElement('div');
	msg_element.style.display='block';
	msg_element.setAttribute('class',notifier_class);
	msg_element.innerText=msg;
	notifier_element.appendChild(msg_element);
	if(window.notifier_timeout) clearTimeout(notifier_timeout);
	notifier_timeout=setTimeout(function(){notifier_element.remove()},_time_lapse);
}
