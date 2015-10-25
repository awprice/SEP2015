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
        //Profile
        if(window.location.pathname == "/profile")
        {
            profile.getDetailsRequest();
            profile.getOffersRequest();
        }
        //Home
        if(window.location.pathname == "/")
        {
            $.ajax({
                dataType: "json",
                method: "GET",
                url: '/api/advertisements/1',
                success: function(data){
                    var htmlBuffer = "";
                    $.each(data.results, function(index, value){
                        console.log(value);
                        htmlBuffer += "<div class='panel panel-danger offer-panel' id='" + value.id + "'>"
                            +"<div class='panel-heading'>"+ value.title + "</div>"
                            +"<div class='panel-body'>"
                            +   value.description
                            +"<br><button class='btn btn-primary ad-info-button'>Info</button>"
                            +"</div>"
                            + "</div>";
                    });
                    $("#job-offers").html(htmlBuffer);
                    $(".ad-info-button").click(function(){
                        var parentOffer = $('.offer-panel');
                        var advertId = $(this).closest(parentOffer).attr('id');
                    });
                }});

        }



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