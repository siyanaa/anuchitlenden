$(document).ready(function() {
    //on select state get distict
    $(document).on('change', '#state_id', function() {
        var state_id = $(this).find('option:selected').data('value');
        var append_to = 'district_id';
        fetchDistrict(state_id, append_to);
    });

    function fetchDistrict(stateId, append_to, next_append = null) {
        $.ajax({
            url: '/admin/utilities/get-districts/' + stateId,
            type: 'GET',
            success: function(response) {

                var clearThisData = $('#' + append_to + '').empty();
                $('#' + append_to + '').append('<option value="" disabled selected>जिल्ला चयन गर्नुहोस्</option>');
                if (response.length > 0) {
                    $.each(response, function(key, value) {
                        $('#' + append_to + '').append('<option value="' + value.name +
                            '">' + value.name + '</option>');
                    });
                } else {
                    $('#' + append_to + '').append(
                        '<option value="">No districts found</option>');
                }
            },
            error: function() {
                console.log("error in the ajax");
            }
        });
    }


    //searching for registration id
    $('#searchInput').on('input', function() {
        var searchTerm = $(this).val(); // Get the value of the input field

        // Make an AJAX request
        $.ajax({
            url: '/admin/utilities/search-district',
            data: {
                query: searchTerm
            },
            success: function(response) {
                $('#searchResults').html(response);

            },
            error: function() {
                $('#searchResults').html("<p>Something wrong!!! Try again</p>");
            }
        });
    });
});