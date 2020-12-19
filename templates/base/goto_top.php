<style>
    #go-to-top {
        display: none;
        position: fixed;
        width: 55px;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        outline: none;
        background-color: #555;
        color: white;
        cursor: pointer;
        padding: 15px;
        border-radius: 50%;
    }
</style>
<button class="btn btn-sm btn-dark" onclick="topFunction()" id="go-to-top" title="Go to top"><i class="fas fa-arrow-up fa-lg"></i></button>

<script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            $('#go-to-top').fadeIn();
        } else {
            $('#go-to-top').fadeOut();
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        $("html, body").animate({
            scrollTop: 0
        }, 500);
    }
</script>