require('./bootstrap');

$(document).ready(function(){
    // Handles toggling the the nav in mobile mode
    $('#hamburger-nav').click(function(){
        $('nav').toggle('slide');
    });
    $('#close-nav').click(function(){
        $('nav').toggle('slide');
    });
    $('.close-nav').click(function(){
        if($('#close-nav').is(":visible"))
        {
            $('nav').toggle('slide');
        }
    });

    // Handles submitting the toggle checkbox forms
    $('.submit-completed').change(function(){
        event.target.closest('form').submit();
    });

    // Handles making sure only one priority checkbox is selected
    $('.priority-checkbox').change(function(){
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if($box.is(":checked"))
        {
            // get all of the other checkboxes
            var group = $('.priority-checkbox');
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        }
        else
        {
            $box.prop("checked", false);
        }
    });

    // Close pop up boxes after 'okay' is hit
    $('.close-box').click(function(){
        $(this).parent().hide();
    });

    // Profile picture toggle input
    $('.profile-picture-link').click(function(){
        $('#profile-picture-input').click();
    });

    // Profile picture submits form
    $('#profile-picture-input').change(function(){
        $('#profile-picture-form').submit();
    });

    // Toggles trashcan/delete button in values list
    $('.trash-can').click(function(){
        // Start by hiding all delete buttons and show
        // All the trashcans
        $('.trash-can').show();
        $('.delete').hide();

        $(this).hide(); // Hide clicked trashcan
        $(this).siblings('.delete').show(); // And show it's delete button

        // Automatically hide the delete button after
        // 2 seconds if user does nothing
        $(this).delay(200).show(1);
        $(this).siblings('.delete').delay(2000).hide(1);
    });

    // Handles submitting seettings
    $('.text-setting').focusout(function(){
        if($(this).val() != null && $(this).val() != '')
        {
            $(this).parent().submit();
        }
    });
});

// Replaces custom alert pop-up boxes
window.sweetAlert = function (title, icon, color, message){
    swal.fire({
        title: `<span class="swal-title" style="color:#ffffff">${title}</span>`,
        icon: icon,
        iconColor: color,
        text: message,
        padding: '.5rem',
        showCancelButton: false,
        confirmButtonColor: '#155466',
        confirmButtonText: 'Okay',
        background: '#3b3b3b',
    }).then((result) => {
        // Don't do anything
    });
}

// For verifying delete forms -- uses sweetalert2
window.verifyDeleteForm = function (message, formID){
    swal.fire({
        title: `<span class="swal-title" style="color:#ffffff">${message}</span>`,
        icon: 'warning',
        iconColor: '#d12828',
        padding: '.5rem',
        showCancelButton: true,
        confirmButtonColor: '#d12828',
        cancelButtonColor: '#155466',
        confirmButtonText: 'Yes, delete it!',
        background: '#3b3b3b',
    }).then((result) => {
        if(result.isConfirmed)
        {
            $(formID).submit();
        }
    });
}