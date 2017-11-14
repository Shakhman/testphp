$(document).ready(function () {

    // AJAX For States
    $.ajax({
        type: 'GET',
        url: 'territory/state',
        dataType: 'json',
        success: function (data) {
            $.each(data, function (key, value) {
                $('<option>').text(value['ter_name']).attr({
                    'data-reg-id': value['reg_id'],
                    'data-ter-id': value['ter_id']
                }).appendTo('#state');
            });
        },
        complete: function () {
            $("#state").chosen({width: '100%'});
        }
    });

    // Change Event For States Select
    $('#state').change(function () {

        $state = $(this).find('option:selected');

        $('#state').prev().text('').hide();

        if ($state.index() !== 0) {
            $('#city').parent().show();
        }

        // AJAX For Cities
        $.ajax({
            type: 'POST',
            url: 'territory/city',
            dataType: 'json',
            data: {
                'regId': $state.attr('data-reg-id')
            },
            success: function (data) {
                if (data.length !== 0) {
                    $('#district').parent().hide();
                    $('#city').empty();
                    $('#district').empty();
                    $('<option>').text('Выберите город').attr({
                        disabled: true,
                        selected: true
                    }).appendTo('#city');

                    $.each(data, function (key, value) {
                        $('<option>').text(value['ter_name']).attr('data-ter-id', value['ter_id']).appendTo('#city');
                    });
                }
                else {
                    $('#city').parent().hide();
                    $('#city').text('');
                    $('#district').parent().show();
                }

            },
            complete: function () {
                $('#city').chosen({width: '100%'}).trigger("chosen:updated");
            }
        });
    });

    // Change Event For Cities Select
    $('#city, #state').change(function () {

        $city = $(this).find('option:selected');

        $('#city').prev().text('').hide();
        $('#district').empty();

        // AJAX For Regions
        $.ajax({
            type: 'POST',
            url: 'territory/district',
            dataType: 'json',
            data: {
                'ter_id': $city.attr('data-ter-id')
            },
            success: function (data) {
                if (data.length !== 0) {
                    $('#district').parent().show();
                    $('#district').empty();
                    $('<option>').text('Выберите район').attr({
                        disabled: true,
                        selected: true
                    }).appendTo('#district');

                    $.each(data, function (key, value) {
                        $('<option>').text(value).appendTo('#district');
                    });
                }
                else {
                    $('#district').parent().hide();
                }
            },
            complete: function () {
                $('#district').chosen({width: '100%'}).trigger("chosen:updated");
            }
        });
    });

    // Change Event For Cities Select
    $('#district').change(function () {
        $('#district').prev().text('').hide();
    });
});