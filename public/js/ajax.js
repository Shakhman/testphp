$(document).ready(function () {

    // AJAX For States
    $.ajax({
        type: 'GET',
        url: 'territory/state',
        dataType: 'json',
        success: function (data) {
            $.each(data, function (key, value) {
                $('<option>').text(value).appendTo('#state');
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
                'state': $state.text()
            },
            success: function (data) {
                $('#city').empty();
                $('#district').parent().hide();
                $('<option>').text('Выберите город').attr({
                    disabled: true,
                    selected: true
                }).appendTo('#city');

                $.each(data, function (key, value) {
                    $('<option>').text(value).appendTo('#city');
                });
            },
            complete: function () {
                $('#city').chosen({width: '100%'}).trigger("chosen:updated");
            }
        });
    });

    // Change Event For Cities Select
    $('#city').change(function () {

        $city = $(this).find('option:selected');

        $('#city').prev().text('').hide();

        // AJAX For Regions
        $.ajax({
            type: 'POST',
            url: 'territory/district',
            dataType: 'json',
            data: {
                'city': $city.text()
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
                } else {
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