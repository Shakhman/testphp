$(document).ready(function () {

    // Errors Obj
    $errorsObj = {
        name: {
            isShort: 'Введите больше 3х букв',
            hasNumber: 'Поле не должно содержать цифры',
            isSpecialChars: 'Поле не должно содержать специальные символы'
        },
        email: {
            notValid: 'Невалидный email'
        },
        state: {
            isNotSelected: 'Выберите область'
        },
        city: {
            isNotSelected: 'Выберите город'
        },
        district: {
            isNotSelected: 'Выберите район'
        },
        common: {
            isEmpty: 'Заполните поле'
        }
    };

    // Name Input Value
    $name = $("#name").keyup(function () {
        $value = $(this).val();
    }).keyup();

    // Email Input Value
    $email = $("#email").keyup(function () {
        $value = $(this).val();
    }).keyup();

    // Hidden Alerts Div
    $('.alert').hide();

    // Validation
    $('#button').click(function () {

        // Validate Name
        if ($name.val().length === 0) {
            $('#name').prev().text($errorsObj.common.isEmpty).show();
            return false;
        }
        else if ($name.val().length <= 3) {
            $('#name').prev().text($errorsObj.name.isShort).show();
            return false;
        } else if ($name.val().match(/[0-9]/g)) {
            $('#name').prev().text($errorsObj.name.hasNumber).show();
            return false;
        }
        else {
            $('#name').prev().text('').hide();
        }

        // Validate Email
        if ($email.val().length === 0) {
            $('#email').prev().text($errorsObj.common.isEmpty).show();
            return false;
        }
        else if (!$email.val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
            $('#email').prev().text($errorsObj.email.notValid).show();
            return false;
        }
        else {
            $('#email').prev().text('').hide();
        }

        // Validate State
        if ($('#state option:selected').val() === $errorsObj.state.isNotSelected) {
            $('#state').prev().text($errorsObj.state.isNotSelected).show();
            return false;
        } else {
            $('#state').prev().text('').hide();
        }

        // Validate City
        if ($('#city option:selected').val() === $errorsObj.city.isNotSelected) {
            $('#city').prev().text($errorsObj.city.isNotSelected).show();
            return false;
        } else {
            $('#city').prev().text('').hide();
        }

        // Validate District
        if ($('#district option:selected').val() === $errorsObj.district.isNotSelected) {
            $('#district').prev().text($errorsObj.district.isNotSelected).show();
            return false;
        } else {
            $('#district').prev().text('').hide();
        }

        // Data For AJAX
        $nameVal = $('#name').val();
        $emailVal = $('#email').val();
        $stateVal = $('#state').val();
        $cityVal = $('#city').val();
        $districtVal = $('#district').val();

        // Submit Form
        $.ajax({
            type: 'POST',
            url: 'user/register',
            dataType: 'json',
            data: {
                'name': $nameVal,
                'email': $emailVal,
                'state': $stateVal,
                'city': $cityVal,
                'district': $districtVal
            },
            success: function (data) {
                if ($.type(data) === 'array') {
                    $('form').hide();
                    $('.well').show();
                    $('.well h4').text(data[0].name);
                    $('.glyphicon-envelope').after('<span>' + data[0].email + '</span>');
                    $('.glyphicon-home').after('<span>' + data[0].territory + '</span>');
                    return true;
                }
                alert('Вы успешно зарегистрировались');
                location.reload();
            }
        });
    });

});