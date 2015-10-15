(function($) {

    $(document).ready(function() {

        console.log("Page loaded.");

        // Restrict all inputs with class .numeric to only enter numbers
        $('input.numeric').numeric();
		$('[data-toggle="tooltip"]').tooltip(); 

        // Compile less and reload styles every 2 seconds
        //setInterval(compileLess, 5000);
		$("input:radio[name='user_type']").change(
			function(){
				var value = $(this).val();
				if(value == "worker") 
				{
					console.log("User set to Worker");
				} else if(value == "employer")
				{
					console.log("User set to Employer");
				}					
			}
		);  
		

    });

    function compileLess() {
        // Compiling less
        console.log('Recompiling less');
        xmlhttp = new XMLHttpRequest();

        xmlhttp.open("GET", "/compile/less", false);
        xmlhttp.send();

        // Reload css
        console.log('Reloading css');
        document.styleSheets.reload();
    }
	
	function login() {
		profile.getDetailsRequest();
	}

})(jQuery);