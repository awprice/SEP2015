var profile = (function(){
	var profileData;
	var displayDetails = function(data) {
		profileData = data.results;
		$("#details_name").find("p").text(profileData.name);
		$("#details_email").find("p").text(profileData.email);
		$("#details_contactno").find("p").text(profileData.contactno);
		$("#details_about").find("p").text(profileData.aboutme);
		
		if(profileData.usertype == "0")
		{
			$("#details_qualifications").show().find("p").text(profileData.qualifications);
		}else if(profileData.usertype == "1")
		{
			$("#details_website").show().find("p").text(profileData.website);
		}
	};
	
	var displayEdit = function(){
		$("#editDetails").show();
		console.log(profileData);
		$("#edit_name").find("input").val(profileData.name);
		$("#edit_email").find("input").val(profileData.email);
		$("#edit_contactno").find("input").val(profileData.contactno);
		$("#edit_about").find("textarea").val(profileData.aboutme);
	};
	
	$("#editDetailsButton").click(function(){
		$("#displayDetails").hide();
		displayEdit();
	});
		
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
			$.ajax({
					dataType: "json",
					method: "GET",
					url: '/api/user',
					data: {},
					success: displayDetails});
		},
		
	}
})();