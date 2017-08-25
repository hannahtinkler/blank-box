/* Markdown Editor **********************************************************/

function getSimpleMde(element) {
    return new window.SimpleMDE({
        element: element,

        // override the preview renderer to allow Prism.js highlighting
        previewRender: function(plainText, preview) { // Async method
            if (plainText.trim() === '') {
                return '';
            }

            identifier = performance.now()

            $(preview).data('identifier', identifier)

            $.post(
                '/ajax/endpoints/pagepreview',
                {
                    content: plainText,
                    identifier: identifier
                }
            ).done(function (response) {
                response = JSON.parse(response)
                console.log(identifier, response.identifier)
                if (identifier == response.identifier) {
                    preview.innerHTML = response.content
                    window.requestAnimationFrame(function () {
                        window.Prism.highlightAll()
                    })
                }
            })

            return "Loading...";
        },
    })
}


/* Top Searchbar ************************************************************/

$(document).ready(function() {

    $('#topbar-search-form').submit(function(e) {
        var term = $('#top-search').val();

        if (!term.length) {
            return false;
        }

        window.location.href ='/search/' + term + '/results';
        e.preventDefault();
        return false;
    });

    $('#top-search').easyAutocomplete({
        adjustWidth: false,
        url: function(term) {
                return "/search/" + term;
        },
        getValue: "content",
        template: {
            type: "links",
            fields: {
                link: "url"
            }
        },
        list: {
            maxNumberOfElements: 10,
            onChooseEvent: function() {
                var url = $('.easy-autocomplete-container ul li.selected div a').attr('href');
                window.location.href = url;
            },
            onShowListEvent: function() {
                var list = $('body').find('#eac-container-top-search ul');
                var term = $('#top-search').val();
                if (list.text().indexOf('View All Results') == -1) {
                    list.append('<li id="view-all"><a href="/search/' + term + '/results"><strong>View All Results</strong></a></li>');
                }
            }
        }
    });


/* Minimalise Navbar *********************************************************/

    $('.navbar-minimalize').click(function () {
        $.get('/ajax/actions/minimalise');
    })
});
