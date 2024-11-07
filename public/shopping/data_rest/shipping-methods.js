$(document).ready(function() {
    // Function to load shipping methods with pagination
    function loadShippingMethods(page = 1) {
        $.ajax({
            url: '/api/shipping-methods?page=' + page,
            method: 'GET',
            success: function(response) {
                var shippingMethods = response.data;  // Dữ liệu các phương thức vận chuyển
                var pagination = response.links; // Liên kết phân trang

                // Clear the list
                $('#shipping-methods-list').empty();

                // Populate the table with shipping methods data
                shippingMethods.forEach(function(method, index) {
                    $('#shipping-methods-list').append(
                        '<tr><td>' + ((page - 1) * 3 + (index + 1)) + '</td>' +
                        '<td>' + method.method_name + '</td>' +
                        '<td>' + method.cost + '</td>' +
                        '<td>' + method.estimated_time + '</td>' +
                        '<td><button class="btn btn-warning edit-method" data-id="' + method.id + '">Edit</button> ' +
                        '<button class="btn btn-danger delete-method" data-id="' + method.id + '">Delete</button></td></tr>'
                    );
                });

                // Clear previous pagination links
                $('#pagination-links').empty();

                // Populate pagination links
                pagination.forEach(function(link) {
                    $('#pagination-links').append(
                        '<a href="javascript:void(0)" class="page-link" data-page="' + link.page + '">' + link.label + '</a>'
                    );
                });
            }
        });
    }

    // Initial load of shipping methods
    loadShippingMethods();

    // Handle pagination clicks
    $(document).on('click', '.page-link', function() {
        var page = $(this).data('page');
        loadShippingMethods(page);
    });

    // You can add logic here for "Edit" and "Delete" buttons (if needed)
});
