$(function(){
    $('select[name="competencyGroup"').on('change', function ()
    {
        var company_id = $(this).val();
        console.log(company_id);
        window.location.href = baseURL+'/competencies?competencyGroup=' + company_id;
    });
});