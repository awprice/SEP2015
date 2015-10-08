var profile = (function(){
	var editMode = false;
	
	return {
		setMode: function(mode){
			if(mode == "edit")
			{
				editMode = true;
			} else {
				editMode = false;
			}
				
			
		}
	}
})