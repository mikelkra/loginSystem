$(document).ready(init());
function init(){
	//hide show effects between login and register form
	$("#loginShow").click(function(){
	    $("#loginRow").fadeIn(800);
	    $("#registerRow").fadeOut(200);
	});
	$("#registerShow").click(function(){
	    $("#registerRow").fadeIn(800);
	    $("#loginRow").fadeOut(200);
	});
	
	//ajax call for login form
	$("#logForm").submit(function(e){
		$.ajax({
			url : "controller/private/Login.Class.php",
			type : "POST",
			data : $("#logForm").serialize(),
			dataType : "json",
			success : function(errorMessage) {
				if(errorMessage == "ok"){
					location.href = " ../../view/welcome.php";
				}else{
					$("#loginAjaxErrorMessage").show();
					$("#loginAjaxErrorMessage").html('<div class="alert alert-danger">'+errorMessage+'</div>');
					$("#loginAjaxErrorMessage").delay(3000).fadeOut(3000);
				}
			}
		});
		e.preventDefault();
	});
	
	//ajax call for register form
	$("#regForm").submit(function(e){
		$.ajax({
			url : "controller/private/Reg.Class.php",
			type : "POST",
			data : $("#regForm").serialize(),
			dataType : "json",
			success : function(errorMessage) {
				if(errorMessage == "ok"){
					$("#registerAjaxErrorMessage").show();
					$("#registerAjaxErrorMessage").html('<div class="alert alert-danger">Register done! Please go to Login.</div>');
					$("#registerAjaxErrorMessage").delay(3000).fadeOut(3000);
				}else{
					$("#registerAjaxErrorMessage").show();
					$("#registerAjaxErrorMessage").html('<div class="alert alert-danger">'+errorMessage+'</div>');
					$("#registerAjaxErrorMessage").delay(3000).fadeOut(3000);
				}
			}
		});
		e.preventDefault();
	});
	
	
	
}



