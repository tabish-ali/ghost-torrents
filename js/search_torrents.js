$(document).ready(function () {

    const search_icon = document.getElementById('search-icon');
    const search_btn = document.getElementById('search-btn');
    const search_field = document.getElementById('search-field');

    search_btn.addEventListener("click", searchTorrents);

    search_field.addEventListener("keydown", function (e) {

        if (e.keyCode === 13) {
            searchTorrents();
        }
    });

    function searchTorrents() {

        if (search_field.value.length > 0) {


            var category = document.querySelector('input[name="category"]:checked').value;

            $.ajax({

                url: "/torrents/search-torrents.php",
                method: "post",
                data: {
                    search_string: search_field.value,
                    category: category
                },
                dataType: "json",

                beforeSend: function () {

                    search_btn.disabled = true;
                    search_icon.className = "fa fa-spinner fa-spin";
                },

                success: function (data) {
                    search_btn.disabled = false;
                    search_icon.className = "fa fa-search";
                    $('#result-div #msg').remove();
                    $('#torrents-table tbody tr').remove();

                    if (data['torrents'].length == 0) {

                        $('#result-div .table').css("display", "none");
                        var notification = "<small id='msg' style='display:block;' class='text-center bg-danger p-1 text-light rounded'>" +
                            "Sorry no results were found for you search, please try again with different keywords. Thanks<small> "
                        $('#result-div').fadeIn("slow");
                        $('#result-div').append(notification);
                        $('#result-div .title-text').remove();

                    }
                    else {
                        $('#result-div .table').fadeIn();
                        $('#result-div').fadeIn();
                        $('#result-div .title-text').remove();
                        $('#result-div').prepend("<h6 class='title-text text-light'> Showing <b>" + data["torrents"].length + "</b> results for <b>( " + data['search_string'] + "</b>  )</h6>");
                        data['torrents'].forEach(torrent => {
                            var torrent_href = "/templates/torrents/show_torrent.php?torrent_id=" + torrent.id;
                            var torrent_row = $("<tr id='torrent-row'><td style='letter-spacing: 0.5px;' class='small'><b>" +
                                "<a class='primary-label' href='" + torrent_href + "'>" +
                                torrent.name + "</b></a></td>" +
                                "<td style='letter-spacing: 0.5px;' class='small'><b> " + torrent.date + " </b></td>" +
                                "<td style='letter-spacing: 0.5px;' class='small'><b> " + torrent.size + " </b></td>" +
                                "<td style='letter-spacing: 0.5px;' class='small'><a href='" + torrent.magnet + "'" + "class='danger-label p-1'>" +
                                "<i class='fa fa-magnet fa-xs'></i>Magnet</a>" +
                                "<a href='" + torrent.path + "'" + "class='text-primary p-1'>" +
                                "<i class='fa fa-file fa-xs'></i>File</a></td>" +
                                "</tr");

                            $("#torrents-table tbody").append(torrent_row);
                        });

                    }
                },
            });
        }
    }
});