var profile = (function(){
	var editMode = false;
	var name = "Bill";
	var email = "test@email.com" 
	
	
	return {
		setMode: function(mode){
			
			if(mode == "edit")
			{
				editMode = true;
			} else {
				editMode = false;
			}
				
			
		},
		getDetailsRequest: function(){},
		displayDetails: function() {},
		
	}
})