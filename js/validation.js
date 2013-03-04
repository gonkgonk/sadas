var Validator = {
	
	init: function(){

		var form = document.getElementById("registerForm");
		var username = document.getElementById("usernameRegistration");
		var password = document.getElementById("passwordRegistration");
		var repeatPassword = document.getElementById("repeatPasswordRegistration");
		
		//Användarnamn
		username.onfocus = function(){
				Validator.setTooltip("Giltiga tecken: A-Z, a-z, 0-9, understreck samt mellan 3-20 tecken!", username);
				username.onblur = function(){
					document.body.removeChild(document.body.lastChild);//Plockar bort tooltipen
				};
			Validator.usernameValidation(username);
		}
		
		//Lösenord
		password.onfocus = function(){
			Validator.setTooltip("Minst en versal, en gemen, en siffra samt vara mellan 6-20 tecken!", password);
				password.onblur = function(){
					document.body.removeChild(document.body.lastChild);//Plockar bort tooltipen
				};
			Validator.passwordValidation(password);
		}
		
		//Upprepat lösenord
		repeatPassword.onfocus = function(){
			Validator.setTooltip("Upprepa föregående lösenord!", repeatPassword);
				repeatPassword.onblur = function(){
					document.body.removeChild(document.body.lastChild);//Plockar bort tooltipen
				};
			Validator.repeatedPasswordValidation(repeatPassword);
		}		
	},
	
	//Validerar användarnamnet
	usernameValidation: function(username){
		username.onchange = function(){
			if (!username.value.match(/^[A-Za-z0-9_]{3,20}$/)) {
                username.id = "wrong";
                username.select();
				return false;
			}
			else{
            	username.id = "correct";
                username.select();
			}
		}
	},
	
	//Validerar lösenord
	passwordValidation: function(password){
		password.onchange = function(){
			if (!password.value.match(/^[A-Za-z0-9_]{6,20}$/)) {
                password.id = "wrong";
                password.select();
				return false;
			}
			else{
            	password.id = "correct";
                password.select();
			}
		}
	},	
	
	//Validerar upprepat lösenord
	repeatedPasswordValidation: function(repeatPassword){
		repeatPassword.onchange = function(){
			if (!repeatPassword.value.match(/^[A-Za-z0-9_]{6,20}$/)) {
                repeatPassword.id = "wrong";
                repeatPassword.select();
				return false;
			}
			else{
            	repeatPassword.id = "correct";
                repeatPassword.select();
			}
		}
	},
	

	//Funktion för tooltip
	setTooltip: function(info, ids){
		var div = document.createElement("div");
		div.className = "tooltip";	
		document.body.appendChild(div);
		var tooltip = document.createTextNode(info);
		div.appendChild(tooltip);
		var pos = Validator.findPos(ids);//Positionerar ut tooltip
		div.style.left = pos[0] + "px";
		div.style.top = pos[1] + "px";			
	},
	
	//Tooltipets position
	findPos: function(obj){
        var curleft = curtop = 0;
        if (obj.offsetParent) {
            do {
                curleft += obj.offsetLeft;
                curtop += obj.offsetTop;
            }
            while (obj = obj.offsetParent);
            return [curleft, curtop];
        }  
    },

	
}

window.onload = Validator.init;

