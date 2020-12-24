$(document).ready(function (e) {

    var loadCompleted = false;

    $('#clear-btn').click(function () {
        $('#search-input').val("");
    });
    $('#test-btn').click(function () {

        $(".container").load("test.php", function () {
          
            console.log("test page loaded");
        });
    });

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
                    var movies = response.data['movies'];
                    $('#result-div').html("");
                    movies.forEach(movie => {

                        // console.log(movie.genres);
                        // movie.torrents.forEach(torrent_element => {

                        // });

                        var col = $("<div style='display:none;' id='movie-col' class='col-sm-3 mt-5'></div>");

                        var img = $("<a href='#'> <img class='movie-img'" +
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

                        col.append(img_div);

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
            });


        }
    });


});