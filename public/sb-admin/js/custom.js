// Booking
$('.no-bookings').hide();
function fetchBookingbyHall(id){

    // Set Value of Hall ID
    $('#hall_id').val(id);

    if(id == 0){
        // Show All
        $('.bookings').removeClass('d-none');
        $('.no-bookings').hide();

        $('.hall-tabs').removeClass('bg-primary text-white');
        $('.hall-tabs').addClass('text-primary');
        $('#show-all-tab').removeClass('text-primary');
        $('#show-all-tab').addClass('bg-primary text-white');

    }else{
        // Filter Bookings by Hall
        $('.bookings').addClass('d-none');
        $('.hall-id-'+id).removeClass('d-none');

        $('.hall-tabs').removeClass('bg-primary text-white');
        $('.hall-tabs').addClass('text-primary');
        $('#hall-tab-'+id).removeClass('text-primary');
        $('#hall-tab-'+id).addClass('bg-primary text-white');

        // Check if 0 Bookings
        if($('.hall-id-'+id).length == 0){
            $('.no-bookings').show();
        }else{
            $('.no-bookings').hide();
        }

    }
}

function removeAllBookings(){
    $(".bookings").addClass('d-none');
}