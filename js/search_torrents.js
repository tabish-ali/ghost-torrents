$(document).ready(function () {

    const result_div = document.getElementById('result-div');
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

            $('#result-div').fadeOut('slow');

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

                    result_div.innerHTML = "";

                    var search_title = document.createElement("small");

                    result_div.className = "mb-4 m-4 dark-bg p-4";

                    search_title.className = "bg-dark text-light p-1 rounded";

                    search_title.appendChild(document.createTextNode("Search Results"));

                    result_div.appendChild(search_title);

                    result_div.appendChild(document.createElement("hr"));

                    search_btn.disabled = false;
                    search_icon.className = "fa fa-search";

                    var count = 0;

                    if (data.length == 0) {

                        var notification = document.createElement("small");
                        notification.appendChild(document.createTextNode("Sorry no results found..."));

                        notification.className = "bg-dark p-1 text-light rounded";
                        $('#result-div').fadeIn("slow");
                        result_div.appendChild(notification);
                    }

                    data.forEach(torrent => {

                        $('#result-div').fadeIn('slow');

                        count++;

                        var result_node = document.createElement("small");

                        var result_link_node = document.createElement("a");

                        result_link_node.href = "/templates/torrents/show_torrent.php?torrent_id="
                            + torrent.id + "&name=" + torrent.name;

                        var result_text = document.createTextNode(count + ". " + torrent.name);

                        result_link_node.appendChild(result_text);

                        result_node.appendChild(result_link_node);

                        result_node.appendChild(document.createElement("br"));

                        result_div.appendChild(result_node);

                    });

                },
            });
        }
    }
});