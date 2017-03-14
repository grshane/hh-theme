jQuery(function( $ ){

    // Add 'shrink' class to site header on scrolling

    // Function to automatically add a top margin to the visible element below .site-header
    function addTopMargin() {
        var header_height = $( ".site-header" ).outerHeight();
        $( ".nav-primary" ).css( "margin-top", header_height + "px" );
    }

    // http://stackoverflow.com/a/1974797/778809
    // Bind to the resize event of the window object
    // $(window).on("resize", function () {
    //     addTopMargin();
    //     // Invoke the resize event immediately
    // }).resize();

});