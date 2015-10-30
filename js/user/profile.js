var profile = (function(){
	var profileData;
	var offers;
	var advertisements;

	var displayAdvertisements = function(data) {
		if(data.success){
			advertisements = data.results;
			$.each(offers, function(index, value){
				console.log(value);
			});
		}
	};
	var displayEdit = function(){
		$("#editDetails").show();
	};
	
	$("#editDetailsButton").click(function(){
		$("#displayDetails").hide();
		displayEdit();
	});
	$("#cancelEditDetails").click(function(){
		$("#editDetails").hide();
		$("#displayDetails").show();

	});

		
	return {
	}
})();