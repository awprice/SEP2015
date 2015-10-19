var profile = (function(){
	var editMode = false;
	var name = "Bill";
	var email = "test@email.com" ;
	var contact = "123456789";
	var about = "I am a worker who does all the work. Yay";
	var qualifications = "Lots of qualifications";
	var displayDetails = function(data) {};
		$("#userName").text(name);
		$("#userEmail").text(email);
		$("#userContactNumber").text(contact);
		$("#userAbout").text(about);
		$("#userQualifications").text(qualifications);
	return {
		setMode: function(mode){
			
			if(mode == "edit")
			{
				editMode = true;
			} else {
				editMode = false;
			}
				
			
		},
		getDetailsRequest: function(){
			$.ajax({dataType: "json",
					url: '/api/user',
					data: {},
					success: displayDetails});
		},
		
	}
})();