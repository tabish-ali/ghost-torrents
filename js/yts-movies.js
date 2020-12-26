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

    function showMovies(response) {
        var movies = response.data['movies'];
        $('#result-div').html("");
        if (movies) {
            movies.forEach(movie => {

                var col = $("<div style='display:none;' id='movie-col' class='col-sm-3 mt-5'></div>");

                var outer_href = $("<a href='/templates/yts/yts_movie_info?slug=" + movie.slug + "&id=" + movie.id + "'></a>");

                var img = $("<img class='movie-img'" +
                    "src='" + movie.large_cover_image + "'> </a>");

                var img_div = $("<div class='img-div'></div>");

                var quality_div = $("<div class='quality-div'></div>");

                var rating_div = $("<div class='rating-div'></div>");

                var rating = $("<h3><b>" + movie.rating + " / 10 </b></h3>");

                var genres_div = $("<div class='genres-div'></div>");

                var i = 0;

                movie.genres.forEach(genre => {
                    // only show 4 genres.
                    if (i < 4) {
                        var genres = $("<h5 class='text-center'><b>" + genre + "</b></h5>");
                        genres_div.append(genres);
                        i++;
                    }
                });

                rating_div.append(rating);

                movie.torrents.forEach(t => {
                    if (t.quality !== "" || t.quality !== null) {
                        var quality_label = $("<small><b>" + t.quality + "</b></small>");
                        quality_div.append(quality_label);
                        quality_div.append(" ");
                    }
                });

                img_div.append(img);
                img_div.append(quality_div);
                img_div.append(rating_div);
                img_div.append(genres_div);
                outer_href.append(img_div);

                col.append(outer_href);

                var title = $("<h6 class='title-text'>" + movie.title + "</h6>");
                var year = $("<small class='text-muted'>Year " + movie.year + " </small>");

                var title_year_div = $("<div class='title-year-div'></div>");

                title_year_div.append(title);
                title_year_div.append(year);

                col.append(title_year_div);
                $('#result-div').append(col);
                col.fadeIn("slow");

            });
            $('#search-icon').removeClass("fa fa-spinner fa-spin");
            $('#search-icon').addClass("fa fa-search");

            $('.movie-img').on("load", function () {
                var movie_parents = $(this).parents();
                var movie_col = $(movie_parents[2]);
                let img_div = $(movie_parents[1]);

                movie_col.find($('.quality-div')).fadeTo(300, 0.7);
                movie_col.find($('.title-year-div')).fadeTo(300, 1);

                img_div.mouseenter(function () {
                    $(this).find($('.rating-div')).fadeTo(300, 1);
                    $(this).find($('.img-div img')).fadeTo(300, 0.3);
                    $(this).find($('.genres-div')).fadeTo(300, 1);

                });
                img_div.mouseleave(function () {
                    $(this).find($('.rating-div')).fadeTo(300, 0);
                    $(this).find($('.img-div img')).fadeTo(300, 1);
                    $(this).find($('.genres-div')).fadeTo(300, 0);

                });
            });

        }
        else {
            var notification = $("<small class='p-1 text-center d-block rounded display-none text-light bg-danger'>No results were found for this search.</small>")
            $('#result-div').append(notification);
            notification.fadeIn("slow");
            $('#search-icon').removeClass("fa fa-spinner fa-spin");
            $('#search-icon').addClass("fa fa-search");
        }
    }

    $('#search-form').submit(function (ev) {
        ev.preventDefault();
        var search_input = $('#search-input').val();

        if (search_input === "") {
            $('#search-div').append("<small class='text-light'>Please write something so we can lookup for you</small>");
        }
        else {
            $('#search-icon').addClass("fa fa-spinner fa-spin");
            $.ajax({
                type: "GET",
                url: "https://yts.mx/api/v2/list_movies.json?query_term=" + search_input,
                dataType: "JSON",

                success: function (response) {

                    showMovies(response);
                }
            });
        }
    });
});