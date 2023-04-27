$('input[name="text"]').on('input', function() {
    var search_term = $(this).val().toLowerCase();
    var $blog_container = $('.blog-container');
    var $blogs = $blog_container.find('.blog');
    $blogs.hide();
    $blogs.each(function() {
        var title = $(this).find('.blog__title').text().toLowerCase();
        var content = $(this).find('.blog__content').text().toLowerCase();
        if (title.indexOf(search_term) !== -1 || content.indexOf(search_term) !== -1) {
            $(this).show();
        }
    });
    $blogs.sort(function(a, b) {
        var a_title = $(a).find('.blog__title').text().toLowerCase();
        var b_title = $(b).find('.blog__title').text().toLowerCase();
        if (a_title.indexOf(search_term) !== -1 && b_title.indexOf(search_term) !== -1) {
            return a_title.localeCompare(b_title);
        } else if (a_title.indexOf(search_term) !== -1) {
            return -1;
        } else {
            return 1;
        }
    });
    $blog_container.append($blogs);
});