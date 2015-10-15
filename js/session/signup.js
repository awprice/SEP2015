var signup = (function(){
	var listenForUserType = function(){
			$("input:radio[name='profile[user-type]']").change(
				function(){
					var value = $(this).val();
					if(value == "worker") 
					{
						console.log("User set to Worker");
						signup.workerFields();
					} else if(value == "employer")
					{
						console.log("User set to Employer");
						signup.employerFields();
					}					
				}
			);
		}
	
	
	return{
		init: function(){
			$("input:radio[name='profile[user-type]'][value='worker']").prop('checked', true);
			this.workerFields();
			listenForUserType();
		},
		workerFields: function(){
			$('#su_qualifications').show();
			$('#su_website').hide();
			$('#su_company_name').hide();
			$('#su_company_name_input').prop('required', false);
			$('#su_company_location').hide();
			$('#su_company_location_input').prop('required', false);
		},
		employerFields: function(){
			$('#su_website').show();
			$('#su_company_name').show();
			$('#su_company_name_input').prop('required', true);
			$('#su_company_location').show();
			$('#su_company_location_input').prop('required', true);
			$('#su_qualifications').hide();
		}
	};
	
})();