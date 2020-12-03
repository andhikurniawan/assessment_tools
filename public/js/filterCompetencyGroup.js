$(function(){
    $('select[name="company"').on('change', function ()
    {
        var company_id = $(this).val();
        console.log(company_id);
        window.location.href = baseURL+'/competencyGroups?company_id=' + company_id;
    });
});