require('./bootstrap');

//---show kms value---//
$(document).ready(function(){
    //---show kms value---//
    $('#kmRange').on('input', function() {
        $("#kmOutput").text($( this ).val());
    });

    //---take selected filters when click on btnFilters---//
    $('#btnFilters').click(function(){
        var rooms = $('#numRooms').val();
        if (!$.isNumeric(rooms)) {
            rooms = 1;
        }
        var guests = $('#numGuests').val();
        if (!$.isNumeric(guests)) {
            guests = 1;
        }
        var distance = $('#kmRange').val();
        var options = [];
        $.each($("input[name='optionSelected_id']:checked"), function(){
        options. push($(this). val());
        });
        console.log(rooms, guests, distance, options);

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/search',
            method: 'POST',
            data: {
                 _token: CSRF_TOKEN,
                distance: distance,
                options: options,
                posti_letto: guests,
                stanze: rooms,

            },
            success:function(data)
            {
                console.log(data)
                //cancella cards in view
                $('.results-search').empty();
                //crea nuove cards
                var source = $("#card-template").html();
                var template = Handlebars.compile(source);
                if (!data.length) {
                    $('.results-search').append('<p class="font-weight-bold w-100 text-center text-info mt-5"> Nessun appartamento trovato </p>');
                }
                for (var i = 0; i < data.length; i++) {
                    console.log(data[i]);
                    var context =
                        {
                            titolo: data[i].titolo,
                            indirizzo: data[i].indirizzo,
                            id: data[i].id
                        };
                    var html = template(context);
                    $('.results-search').append(html);
                    truncateTitle();
                }

            },
            error:function (err) {
                console.log(err)
            }
        });
    });

    truncateTitle();

    //---truncate title---//
    function truncateTitle() {
        $('.card-title').each(function(){
            // console.log($(this).text());
            var text = $(this).text();
            if (text.length > 29) {
                // console.log(text);
                var truncatedTitle = text.slice(0, 30) + '...';
                // console.log(truncatedTitle);
                $(this).text(truncatedTitle);
            }
        });
    }


});
