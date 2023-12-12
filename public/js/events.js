$('.btn-number').click(function (e) {
    e.preventDefault();

    var fieldName = $(this).attr('data-field');
    var type = $(this).attr('data-type');
    var input = $('input[name="' + fieldName + '"]');
    var currentVal = parseInt(input.val());

    if (!isNaN(currentVal)) {
        if (type === 'minus' && currentVal > 1) {
            input.val(currentVal - 1);
        } else if (type === 'plus') {
            input.val(currentVal + 1);
        }
    } else {
        input.val(1);
    }
});
