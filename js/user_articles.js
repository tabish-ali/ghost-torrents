$(document).ready(function () {

    var edit_btn_array = Array();

    var delete_selection = Array();

    var selected_articles_count = 0;

    // store id's of selected articles
    var selected_articles = Array();

    var delete_btn = document.getElementById("delete-btn");

    var select_all_choicebox = document.getElementById("select-all-choicebox");

    setActionButtons();
    delete_btn.addEventListener("click", deleteArticleConfirmation);
    select_all_choicebox.addEventListener("click", function () {
        delete_selection.forEach(element => {
            if (element != undefined) {
                element.checked = select_all_choicebox.checked;
                delete_btn.disabled = !select_all_choicebox.checked
                if (select_all_choicebox.checked) {
                    selected_articles_count = delete_selection.length - 1;
                    articles.forEach(article => {
                        if (!selected_articles.includes(article))
                            selected_articles.push(article);
                    });
                }
                else {
                    selected_articles_count = 0;
                    articles.forEach(article => {
                        selected_articles.pop(article);
                    });
  
                }
            }
        });


    });

    function deleteArticleConfirmation() {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this article!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    deleteArticle();
                    deleteTableRows();
                    swal("Poof! Your article file has been deleted!", {
                        icon: "success",
                    });
                } else {

                }
            });

    }

    function deleteTableRows() {
        articles_to_del = Array();
        articles.forEach(element => {
            if (element.delete_selection.checked) {

                row_index = element.delete_selection.parentElement.parentElement.rowIndex;
                document.getElementById('articles-table').deleteRow(row_index);
                articles_to_del.push(element);
            }
        });

        articles_to_del.forEach(element => {

            articles.pop(element);
        });

        if (articles.length < 1) {

            delete_btn.disabled = true;
        }
    }

    function deleteArticle() {
        var selected_articles_json = JSON.stringify(selected_articles);
        $.ajax({
            type: 'POST',
            data: { selected_articles_json: selected_articles_json },
            url: '/articles/delete-articles.php',
            header: 'Content-type:appSMALLcation/json',
            success: function (data) {
            }

        });
    }

    function setActionButtons() {

        var articles_table = document.getElementById('articles-table');

        var rows_length = articles_table.rows.length;

        for (var i = 0; i < rows_length; i++) {

            edit_btn_array.push(articles_table.rows[i].cells[3].firstChild);

            delete_selection.push(articles_table.rows[i].cells[0].childNodes[1]);

        }

        var btn_counter = 1;

        articles.forEach(element => {

            element.edit_btn = edit_btn_array[btn_counter];
            element.delete_selection = delete_selection[btn_counter];
            btn_counter++;
        });
        articles.forEach(element => {
            element.delete_selection.addEventListener("click", function () {
                if (element.delete_selection.checked) {
                    selected_articles_count++;
                    selected_articles.push(element);
               
                }
                else {
                    selected_articles_count--;
                    selected_articles.pop(element);
                }

                if (selected_articles_count > 0) {
                    delete_btn.disabled = false;
                }
                else {
                    delete_btn.disabled = true;
                }
            });

        });
    }

});