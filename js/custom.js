(function($) {

    $(document).ready(function() {

        console.log("Page loaded.");

        // Restrict all inputs with class .numeric to only enter numbers
        $('input.numeric').numeric();
		$('[data-toggle="tooltip"]').tooltip(); 

        // Compile less and reload styles every 2 seconds
        //setInterval(compileLess, 5000);
		
		//Sign Up
		signup.init(); 
		profile.getDetailsRequest();
        $.ajax({
            dataType: "json",
            method: "GET",
            url: '/api/advertisements/1',
            success: function(data){
                console.log(data.results);
                $('#job-offers').text(data.results[0].title);
            }});


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

})(jQuery);