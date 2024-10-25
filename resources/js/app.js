import './bootstrap';

// Import Bootstrap's JavaScript
import * as bootstrap from 'bootstrap';

// Make Bootstrap globally available
window.bootstrap = bootstrap;

// Import Bootstrap Icons CSS
import 'bootstrap-icons/font/bootstrap-icons.css';

// Import jQuery
import $ from 'jquery';
window.$ = window.jQuery = $;

// Import Toastr
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

// Toastr configuration
toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "5000"
};


// Initialize DataTables
$(document).ready(function () {
    $('#users-table').DataTable();
    $('#categories-table').DataTable();
    $('#blogs-table').DataTable();

    if (window.Laravel.successMessage) {
        toastr.success(window.Laravel.successMessage);
    }

    if (window.Laravel.errorMessage) {
        toastr.error(window.Laravel.errorMessage);
    }
    $('.delete-btn').on('click', function (e) {
        e.preventDefault();

        const deleteUrl = $(this).data('url');
        const itemId = $(this).data('id');
        const itemType = $(this).data('type');
        const blogCount = itemType === 'user' ? 
            parseInt($(this).data('blogs-count')) : 0;
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        let confirmMessage = '';
        if (itemType === 'user') {
            confirmMessage = blogCount > 0 
                ? `This user has ${blogCount} blog(s). Deleting this user will also delete all their blogs.` 
                : 'Are you sure you want to delete this user?';
        } else if (itemType === 'category') {
            confirmMessage = blogCount > 0 
                ? `Cannot delete category with associated blogs. Please remove or reassign the blogs first.`
                : 'Are you sure you want to delete this category?';
        }

        // If category has blogs, show error message instead of confirmation
        if (itemType === 'category' && blogCount > 0) {
            Swal.fire({
                title: 'Cannot Delete',
                text: confirmMessage,
                icon: 'error',
                confirmButtonColor: '#3085d6'
            });
            return;
        }

        // For normal deletion confirmation
        Swal.fire({
            title: `Delete ${itemType}?`,
            html: confirmMessage,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    data: { _token: csrfToken }
                }).then(response => {
                    if (!response.success) {
                        throw new Error(response.message || 'Something went wrong!');
                    }
                    return response;
                }).catch(error => {
                    throw new Error(error.responseJSON?.message || error.message || 'Something went wrong!');
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value.success) {
                    // Show success message with OK button
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: result.value.message || `${itemType} has been deleted successfully.`,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload(); // Reload the page when OK is clicked
                        }
                    });
                } else {
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: result.value.message || 'Failed to delete item.'
                    });
                }
            }
        }).catch(error => {
            // Show error message
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.message || 'Something went wrong!'
            });
        });
    });
});

// Initialize Parsley
$(function () {
    $('form').parsley();
});

import 'datatables.net-bs5';

// Example usage
// toastr.success('Success message');
// toastr.error('Error message');

import Swal from 'sweetalert2';
window.Swal = Swal;
