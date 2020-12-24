$(document).ready(function (e) {

    $('#get-movies').on('click', getMovies);

    function getMovies() {

        $.ajax({

            type: "GET",
            url: "https://yts.mx/api/v2/list_movies.json?query_term='mad max'",
            dataType: "JSON",

            success: function (response) {
                console.log(response);
            }
        });
    }
});