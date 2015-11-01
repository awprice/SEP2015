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
        //Home
        var getAdvertDetails = function(id){

        };
        var initAdListeners = function(){
            $(".ad-info-button").click(function(){
                var parentAdvert = $('.advert-panel');
                var advertId = $(this).closest(parentAdvert).attr('id');
                $.ajax({
                    dataType: "json",
                    method: "GET",
                    url: '/api/advertisement/' + advertId,
                    success: function(data){
                        console.log(data.results);
                    }});
            });
        };
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
                        htmlBuffer += "<div class='panel panel-warning advert-panel' id='" + value.id + "'>"
                            + "<div class='panel-heading'>"+ value.title + "</div>"
                            + "<div class='panel-body'>"
                            +   value.description
                            + "</div>"
                            + "<div class='panel-footer'>"
                            + "<a href='/advertisement/" + value.id + "' class='btn btn-primary ad-info-button'>Info</a>"
                            + "</div>"
                            + "</div>";
                    });
                    var jobContainer = $("#advertisements-holder");
                    jobContainer.html(htmlBuffer);
                    jobContainer.fadeIn();

                    initAdListeners();
                }});

        }

        $('.rating').raty({
            path: '/img',
            score: 1,
            scoreName: 'rating[score]'
        });

        $('.panel-listing .panel-heading').click(function () {
            var panel = $(this).parents('.panel-listing'),
                body = $(panel).find('.panel-body');

            if ($(body).is(':hidden')) {
                $(body).slideDown('fast');
            } else {
                $(body).slideUp('fast');
            }
        });

        $('#home-search').click(function() {
            var query = $('#home-search-input').val();
            window.location.href = "/search/" + query;
        });

        $('#home-search-input').keypress(function (e) {
            if (e.which == 13) {
                var query = $('#home-search-input').val();
                window.location.href = "/search/" + query;
                return false;
            }
        });

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