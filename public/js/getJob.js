$(function () {
    $('select[name="assessment"]').on('change', function () {
        var assessment = $(this).val();
        if (assessment) {
            $.ajax({
                url: APP_URL +'/api/jobs/getDataJob/' + assessment,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    $('#loader').css("visibility", "visible");
                },
                success: function (data) {
                    $('select[name="job"]').empty();
                    $('select[name="job"]').append('<option value="0">All Job</option>');
                    $.each(data, function (key, value) {
                        $('select[name="job"]')
                            .append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                complete: function () {
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="job"]').empty();
            $('select[name="job"]').append('<option value="0">Job Not Available</option>');
        }

    });
});
