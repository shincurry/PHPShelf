function inputCheck(str, type){
		var xmlhttp;
		if (str.length == 0){
			document.getElementById("errorMessage").innerHTML = "";
			canRegis()
			return;
		}
		if (window.XMLHttpRequest){
			xmlhttp = new XMLHttpRequest();
		}else{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById("errorMessage").innerHTML = xmlhttp.responseText;
				canRegis()
		    }
		}
		if (type == "passwordAgain"){
			xmlhttp.open("GET","./includes/inputCheck.php?txt=" + str + "&type=" + type + "&password=" + document.getElementById("password").value, true);
		}else{
			xmlhttp.open("GET","./includes/inputCheck.php?txt=" + str + "&type=" + type, true);
		}
		xmlhttp.send();
}
	
function canRegis(){
	if (document.getElementById("errorMessage").innerHTML == "" && 
		document.getElementById("username").value != "" &&
		document.getElementById("password").value != "" &&
		document.getElementById("passwordAgain").value != "" &&
		document.getElementById("email").value != ""){
				document.reg.submit.disabled = false;
	}else{
		document.reg.submit.disabled = true;
	}
}

$(document).ready(function(){
	$("#tableEdit").click(function(){
		
		if ($("#tableEdit").attr("value") == "notEdit"){
			$("#tableEdit").text("取消编辑");
			$("#tableDelete").removeAttr("disabled");
			$("#tableModify").removeAttr("disabled");
			$("#tableEdit").val("Editing");
			var needDelete = new Array();
		}else{
			$("#tableEdit").text("编辑");
			$("#tableDelete").attr("disabled", "disabled");
			$("#tableModify").attr("disabled", "disabled");
			$("#tableEdit").val("notEdit");
		}
		
	});
	
	while ($("#tableEdit").attr("value") == "Editing"){
		
	}
});

