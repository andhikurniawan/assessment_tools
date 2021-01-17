$(function () {
    $('select[name="assessment"]').on('change', function () {
        var assessment = $(this).val();
        if (assessment) {
            $.ajax({
                url: APP_URL +'/api/teams/getDataTeam/' + assessment,
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
