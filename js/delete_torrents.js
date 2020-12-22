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
        torrents.forEach(element => {
            if (select_all.checked) {
                selected_torrents_count = torrents.length;
                selected_torrents.push(element);
                delete_btn.disabled = false;
            }
            else {
                selected_torrents.pop(element);
                selected_torrents_count = 0;
                delete_btn.disabled = true;
            }
        });

        delete_selection.forEach(element => {
            if (element != null) {
                if (select_all.checked) {
                    element.checked = true;
                }
                else {
                    element.checked = false;
                }
            }
        });
    });

    function deleteTorrents() {
        var selected_torrents_json = JSON.stringify(selected_torrents);

        console.log(selected_torrents_json);

        $.ajax({
            type: 'POST',
            data: { selected_torrents_json: selected_torrents_json },
            url: '/torrents/delete-torrents.php',
            header: 'Content-type:appSMALLcation/json',
            dataType: "json",
            success: function (data) {
                console.log(data);
                delete_selection = [];
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
            element.delete_selection.addEventListener("click", function () {

                if (element.delete_selection.checked) {
                    if (!containsObject(element, selected_torrents)) {
                        selected_torrents.push(element);
                        selected_torrents_count++;
                    }
                }
                else {
                    if (containsObject(element, torrents)) {
                        selected_torrents_count--;
                        selected_torrents.pop(element);
                    }
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
    function containsObject(obj, list) {
        var i;
        for (i = 0; i < list.length; i++) {
            if (list[i] === obj) {
                return true;
            }
        }
        return false;
    }
});