RCRegexEmail = "^[A-Za-z0-9_\.\-]+@[A-Za-z0-9_\.\-]+[.]{1}[A-Za-z0-9_\.\-]+$";
RCRegexDate = "^[0-9]{1,2}[ ]+[A-Za-z]{3}[ ]+[0-9]{4}|[0-9]{1,2}[-/.]{1}[0-9]{1,2}[-/]{1}[0-9]{4}$";
RCRegexNumber = "^([0-9]+)?(\.[0-9]+)?$";
function isDefined(x) {
	if(typeof(x) != "undefined") return true;
	else return false;
}
function RCSetupForms() {
	// For each form on the page
	for(i=0; i < document.forms.length; i++) {
		// Add a 'submit' event listener
		document.forms.item(i).addEventListener('submit', RCHandleFormSubmit, false);
		// Some HTML5 elements render retardedly
		for(j=0; j<document.forms.item(i).elements.length; j++) {
			e = document.forms.item(i).elements.item(j);
			if(e.getAttribute('type') == 'date') {
				e.setAttribute('type', 'text');
				e.setAttribute('pattern', RCRegexDate);
			} else if(e.getAttribute('type') == 'email') {
				e.setAttribute('pattern', RCRegexEmail);
			} else if(e.getAttribute('type') == 'number') {
				e.setAttribute('type', 'text');
				e.setAttribute('pattern', RCRegexNumber);
			}
		}
	}
}
function RCHandleFormSubmit(event) {
	elements = event.target.elements;
	formErrors = false;
	for(i=0; i < elements.length; i++) {
		if(elements.item(i).checkValidity && elements.item(i).checkValidity() == false)
			formErrors = true;
	}
	if(typeof(validate) == 'function') {
		if(!validate(event.target))
			formErrors = true;
	}
	if(formErrors) {
		event.preventDefault();
		return false;
	}
	return true;
}
window.addEventListener('load', RCSetupForms, false);

function formatDate(input) {
	if(input.value == "")
		return;
	if(input.value.match( /[0-9]{4}$/ ) == null) {
		x = input.value.substr(0, input.value.length - 2);
		y = input.value.substr(input.value.length - 2);
		input.value = x + "20" + y;
	}
	months = new Array();
	months[0] = "Jan";
	months[1] = "Feb";
	months[2] = "Mar";
	months[3] = "Apr";
	months[4] = "May";
	months[5] = "Jun";
	months[6] = "Jul";
	months[7] = "Aug";
	months[8] = "Sep";
	months[9] = "Oct";
	months[10] = "Nov";
	months[11] = "Dec";
	date = new Date(input.value);
	if(isNaN(date.valueOf())) {
		alert( "Invalid date. Try one of these formats (or a similar variation):\n\n23 feb 06     feb 23, 06     2/23/06" );
		return;
	}
	input.value = date.getDate() + " " + months[date.getMonth()] + " " + date.getFullYear(); 
}
function formatDateTime(input) {
	if(input.value == "")
		return;
	/*	
	if( input.value.match( /[0-9]{4}$/ ) == null )
	{
		x = input.value.substr( 0, input.value.length - 2 );
		y = input.value.substr( input.value.length - 2 );

		input.value = x + "20" + y;
	}
	*/
	date = new Date( input.value );
	if(isNaN(date.valueOf())) {
		alert( "Invalid date/time. Try this format:\n\n23 feb 06 3:30 pm" )
		return;
	}
	months = new Array();
	months[0] = "Jan";
	months[1] = "Feb";
	months[2] = "Mar";
	months[3] = "Apr";
	months[4] = "May";
	months[5] = "Jun";
	months[6] = "Jul";
	months[7] = "Aug";
	months[8] = "Sep";
	months[9] = "Oct";
	months[10] = "Nov";
	months[11] = "Dec";	
	//input.value = date.toLocaleString(); 
	input.value = date.getDate() + " " + months[date.getMonth()] + " " + date.getFullYear() + " " + pad(date.getHours()) + ":" + pad(date.getMinutes());
}
function formatTimeInterval(input) {
	if(input.value == '')
		return;
	// check if only a single integer was given and assume it was just hours
	if(input.value.match(/^[0-9]{1,2}$/) != null) {
		input.value += ':00';
	}
}
function formatPhone(input) {
	if( input.value == "" )
		return;
	oldValue = input.value;
	input.value = input.value.replace( /[ \-()\.]/g, '' );
	switch(input.value.length) {
		case 7:
			alert( "Please give an area code" );
			input.value = oldValue;
			break;
		case 10:
			newStr = "(";
			newStr += input.value.substr( 0, 3 );
			newStr +=") ";
			newStr += input.value.substr( 3, 3 );
			newStr += "-";
			newStr += input.value.substr( 6, 4 );
			input.value = newStr;
			break;
		default:
			alert( "Invalid phone number." );
			input.value = oldValue;
	}
}
function convertToDecimal( x ) {
	if( x.value.match( /^[0-9.+\/]+$/ ) )
		x.value = eval( x.value );
	else
		alert( "Invalid expression. Please check for spaces and enter fractions like this: 4+5/8." );
}