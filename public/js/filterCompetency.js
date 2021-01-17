$(function () {
    $('select[name="companyName"]').on('change', function () {
        var companyName = $(this).val();
        if (companyName) {
            $.ajax({
                url: APP_URL +'/api/competencies/getData/' + assessment,
                type: 'get',
                dataType: 'json',
                beforeSend: function () {
                    $('#loader').css("visibility", "visible");
                },
                success: function (data) {
                    $('select[name="team"]').empty();
                    $('select[name="team"]').append('<option value="0">All Team</option>');
                    $.each(data, function (key, value) {
                        $('select[name="team"]')
                            .append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                complete: function () {
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="team"]').empty();
            $('select[name="team"]').append('<option value="0">Team Not Available</option>');
        }

    });
});
