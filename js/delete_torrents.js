$(document).ready(function () {

    const delete_btn = document.getElementById('delete-btn');

    const select_all = document.getElementById("select-all");

    var edit_btn_array = Array();

    var delete_selection = Array();

    var selected_torrents = Array();

    var selected_torrents_count = 0;

    setActionButtons();

    delete_btn.addEventListener("click", deleteTorrentConfirmation);

    select_all.addEventListener("click", function () {

        delete_selection.forEach(element => {

            if (element != undefined) {
                element.checked = select_all.checked;
                delete_btn.disabled = !select_all.checked

                if (select_all.checked) {
                    selected_torrents_count = delete_selection.length - 1;
                }
                else {
                    selected_torrents_count = 0;
                }
            }
        });



    });

    function deleteTorrents() {

        var selected_torrents_json = JSON.stringify(selected_torrents);

        $.ajax({
            type: 'POST',
            data: { selected_torrents_json: selected_torrents_json },
            url: '/torrents/delete-torrents.php',
            header: 'Content-type:appSMALLcation/json',
            success: function (data) {

                console.log(data);
            }

        });
    }

    function deleteTorrentConfirmation() {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this article!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    deleteTorrents();
                    deleteTableRows();
                    swal("Poof! Your Torrents has been deleted!", {
                        icon: "success",
                    });
                } else {

                }
            });

    }

    function deleteTableRows() {

        torrents_to_del = Array();

        torrents.forEach(element => {

            if (element.delete_selection.checked) {

                row_index = element.delete_selection.parentElement.parentElement.rowIndex;
                document.getElementById('torrents-table').deleteRow(row_index);

                torrents_to_del.push(element);
            }
        });

        torrents_to_del.forEach(element => {

            torrents.pop(element);
        });

        if (torrents.length < 1) {

            delete_btn.disabled = true;
        }
    }

    function setActionButtons() {

        var torrents_table = document.getElementById('torrents-table');

        var rows_length = torrents_table.rows.length;

        for (var i = 0; i < rows_length; i++) {

            edit_btn_array.push(torrents_table.rows[i].cells[3].firstChild);

            delete_selection.push(torrents_table.rows[i].cells[0].childNodes[1]);

        }

        var btn_counter = 1;

        torrents.forEach(element => {

            element.edit_btn = edit_btn_array[btn_counter];
            element.delete_selection = delete_selection[btn_counter];

            btn_counter++;
        });

        torrents.forEach(element => {

            element.edit_btn.addEventListener("click", function () {


            });

            element.delete_selection.addEventListener("click", function () {

                if (element.delete_selection.checked) {
                    selected_torrents_count++;
                    selected_torrents.push(element.id);
                }
                else {
                    selected_torrents_count--;
                    selected_torrents.pop(element.id);
                }

                if (selected_torrents_count > 0) {
                    delete_btn.disabled = false;
                }
                else {
                    delete_btn.disabled = true;
                }
            });

        });
    }

    });