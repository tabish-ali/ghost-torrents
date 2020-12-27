$(document).ready(function (e) {

    $('#clear-btn').click(function () {
        $('#search-input').val("");
    });

    var suggestions_dropdown = $('#suggestions-dropdown');
    var input = $('#search-input');
    var typingTimer;                //timer identifier
    var doneTypingInterval = 500;

    //on keyup, start the countdown
    input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(suggestions, doneTypingInterval);
        console.log("keyup");
    });

    //on keydown, clear the countdown 
    input.on('keydown', function () {
        clearTimeout(typingTimer);
        console.log("down");
    });

    const target_input_field = document.querySelector('#search-input')
    const target_dropdown = document.querySelector('#suggestions-dropdown')

    document.addEventListener('click', (event) => {
        const withinBoundaries1 = event.composedPath().includes(target_input_field)
        const withinBoundaries2 = event.composedPath().includes(target_dropdown)

        if (!(withinBoundaries1 || withinBoundaries2)) {
            suggestions_dropdown.fadeOut();
        }
    });

    input.focus(function () {
        if (input.val().length >= 3) {
            suggestions();
            console.log("foucs");
        }
    });

    function suggestions() {

        $('#search-icon').removeClass("fa fa-search");
        $('#search-icon').addClass("fa fa-spinner fa-spin");

        $('.holder').append(suggestions_dropdown);
        suggestions_dropdown.fadeIn("slow");

        if (input.val() !== "") {
            $.ajax({
                type: "GET",
                url: "https://yts.mx/api/v2/list_movies.json?query_term=" + input.val() + "&limit=5&with_cast=true&with_images=true&with_rt_ratings=true",
                dataType: "JSON",
                success: function (response) {
                    var movies = response.data['movies'];
                    suggestions_dropdown.html("");
                    if (movies) {
                        movies.forEach(movie => {
                            var link = $("<a class='primary-label' href='/templates/yts/yts_movie_info?slug=" + movie.slug + "&id=" + movie.id + "'></a>");
                            var suggestion_div = $("<div class='row mt-1 text-light'></div>")
                            var img_div = $("<div class='col-sm-3'></div>")
                            var img = $("<img class='small-img'" +
                                "src='" + movie.small_cover_image + "'> </a>");
                            img_div.append(img);
                            suggestion_div.append(img_div);

                            var info_div = $("<div class='col-sm-9'></div>");
                            var title = $("<small class='font-weight-bold'>" + movie.title + "<small> <br>");
                            var year = $("<small class='text-muted'>" + movie.year + " </small>");

                            info_div.append(title);
                            info_div.append(year);

                            suggestion_div.append(info_div);
                            link.append(suggestion_div);
                            suggestions_dropdown.append(link);
                        });
                    }
                    else {
                        suggestions_dropdown.append("<small class='font-weight-bold'>Sorry no results were found...<small>");
                    }
                    $('#search-icon').removeClass("fa fa-spinner fa-spin");
                    $('#search-icon').addClass("fa fa-search");

                }
            });
        }
    }

});