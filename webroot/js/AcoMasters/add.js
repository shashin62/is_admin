$(function () {
    // Setup validation
    // ------------------------------

    $.validator.addMethod(
            "regex",
            function (value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Please check your input."
            );

    // As found on http://www.regexlib.com/Search.aspx?k=email&c=-1&m=5&ps=20
    $.validator.methods.email = function (value, element) {
        return this.optional(element) || /^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z0-9.-]+$/.test(value);
    };

    // Initialize
    var validator = $(".form-validate-jquery").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass);
        },
        // Different components require proper error label placement
        errorPlacement: function (error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo(element.parent().parent().parent().parent());
                }
                else {
                    error.appendTo(element.parent().parent().parent().parent().parent());
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo(element.parent().parent().parent());
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo(element.parent());
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo(element.parent().parent());
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo(element.parent().parent());
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function (label) {
            label.addClass("validation-valid-label").text("Success.");
        },
        rules: {

        },
        messages: {
            custom: {
                required: "This is a custom error message"
            },
            agree: "Please accept our policy"
        }
    });

    // Reset form
    $('#reset').on('click', function () {
        validator.resetForm();
    });

    // Format icon
    function iconFormat(icon) {
        var originalOption = icon.element;
        if (!icon.id) {
            return icon.text;
        }
        var $icon = "<i class='" + $(icon.element).data('icon') + "'></i>" + icon.text;

        return $icon;
    }

    // Initialize with options
    $(".select-icons").select2({
        templateResult: iconFormat,
        templateSelection: iconFormat,
        escapeMarkup: function (m) {
            return m;
        }
    });

    $('.select').select2()
            .on("change", function (e) {
                validator.element(this);
            });

    $(document).on('change', '#type', function () {
        if (this.value == '0')
            h1(true);
        else if (this.value == '1')
            h1(false);
        else
            h1(false);
    });

    $(document).on('change', '#menu_type', function () {
        if (this.value == '0')
            h2(false);
        else if (this.value == '1')
            h2(true);
        else
            h2(false);
    });
    
    if ($('#type').val() == '0')
        h1(true);
    else if ($('#type').val() == '1')
        h1(false);
    else
        h1(false);

    if ($('#menu_type').val() == '0')
        h2(false);
    else if ($('#menu_type').val() == '1')
        h2(true);
    else
        h2(false);

});

function h1(flag) {
    flag === true ? $('#type_div').show() : $('#type_div').hide();
    $('#menu_type').prop('required', flag);
}

function h2(flag) {
    flag === true ? $('#menu_type_div').show() : $('#menu_type_div').hide();
    $('#glyphicon').prop('required', flag);
    $('#controller').prop('required', flag);
    $('#action').prop('required', flag);
}