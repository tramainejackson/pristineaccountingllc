$(document).ready(function() {

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')	},
        cache: false
    });

    // Commonly user variables
    var winHeight = window.innerHeight;
    var winWidth = window.innerWidth;
    var screenHeight = screen.availHeight;
    var screenWidth = screen.availWidth;

    // SideNav Button Initialization
    $(".button-collapse").sideNav();
    // SideNav Scrollbar Initialization
    var sideNavScrollbar = document.querySelector('.custom-scrollbar');
    var ps = new PerfectScrollbar(sideNavScrollbar);

    // Since fixed height for nav, add nav height to container
    $('#content_container').css({'margin-top':$('nav').height() + 'px'});

    // Animations initialization
    new WOW().init();

    // Initialize MDB select
    $('.mdb-select').materialSelect();

    // Work around for select search not working
    $(".mdb-select").find(".search").on("click", function (e) {
        e.preventDefault();
        $(this).focus();
    });

    //Toggle value for checked item
    $("body").on("click", ".propUtilSwitch", function(e) {
        $(this).toggleClass('btn-success active btn-blue-grey');

        if($(this).children().attr('checked') == 'checked') {
            $(this).children().removeAttr('checked');
        } else {
            $(this).children().attr('checked', 'checked');
        }
    });

    // Remove an added requirement that hasn't been saved yet
    $('body').on('click', '.removeRequirement', function() {
        var inputGroup = $(this).parents('.input-group');
        $(inputGroup).addClass('animated bounceOut');

        setTimeout(function() {
            $(inputGroup).remove();
        }, 1000);
    });

    // Remove an added requirement that hasn't been saved yet
    $('body').on('click', '.deleteRequirement', function(e) {
        // Get the requirement id
        var requirement = $(this).parents('.input-group').find('input.hidden');

        // Send input field to deleteRequirement function
        deleteRequirement(requirement);
    });

    // Add a requirement input group to the requirements
    // form block
    $('body').on('click', '.addRequirementBtn', function() {
        var inputGroup = $(this).parent().find('.input-group:not(.animated)').clone();
        var formGroup = $(this).next();

        // Animate input group when added to DOM
        $(inputGroup).show().addClass('animated bounceIn').appendTo($(formGroup));
    });

    // Initialize the datetimepicker
    $('#datetimepicker, .datetimepicker').pickadate({
        // Escape any “rule” characters with an exclamation mark (!).
        format: 'mm/dd/yyyy',
        formatSubmit: 'yyyy/mm/dd',
    });

    $('#timepicker, .timepicker').pickatime({
        // 12 or 24 hour
        twelvehour: true,
        autoclose: true,
        default: '18:00',
    });

    // Dropdown Init
    $('.dropdown-toggle').dropdown();

    // Remove flash message if there is one after 8 seconds
    if($('.flashMessage').length == 1) {
        $('.flashMessage').animate({top:'+=' + ($('nav').height() + 150) + 'px'});
        setTimeout(function(){
            $('.flashMessage').animate({top:'-150px'}, function(){
                // $('.flashMessage').remove();
            });
        }, 8000);
    }

    // Disable submit button once selected
    $('body').on('click', '.add_contact_form input[type="submit"], #contact_add  input[type="submit"]',  function(e) {
        // e.preventDefault();

        $(this).attr('disbaled', true);
    });

    // Remove disabled from the document title input
    // when a document is added
    $('[name="document[]"]').on('change', function() {
        $('[name="document_title"]').removeAttr('disabled').focus();
    });

    // Add progress spinner when submitting form
    $(".consult_request_form").submit(function(e) {
        $('.loadingSpinner p').text('Sending Contact Information');

        $('.loadingSpinner').modal('show');
    });

    // Add/Remove mask on media items when checkbox is selected/deselected
    $('body').on('change', ':checkbox', function() {
        var counter=0;

        $('.mediaBlock :checkbox').each(function() {
            if($(this).prop('checked')) {
                $(this).parent().next().find('.mask').removeClass('invisible');
                counter++;
            } else {
                $(this).parent().next().find('.mask').addClass('invisible');
            }
        });

        if(counter > 0) {
            $('button.removeMediaBtn').fadeIn();
        } else {
            $('button.removeMediaBtn').slideUp();
        }
    });

    // Add the selected media item to the modal for delete verification
    $('body').on('click', '.removeMediaBtn', function() {
        if($('.mediaBlock input:checked').length > 0) {
            $('.mediaBlock input:checked').each(function() {
                var mediaObject = $(this).parent().next().clone();

                $(this).appendTo($(mediaObject));
                $(mediaObject).find('.mask').hide();
                $(mediaObject).prependTo($('#property_media form .row'));
            });
        }
    });

    // Bring up save input button if any of the information is changed on the
    // showing card
    $('body').on('change', '.showingCard input, .showingCard textarea', function() {
        $(this).parent().parent().find('input[name="update_showing"]').slideDown();
    });

    // Bring up delete modal for deletions
    $('body').on('click', '.deleteBtn, .removeImage, .removeWelcomeMedia', function(e) {
        e.preventDefault();

        // If removing carousel Image
        // Add Image to input value
        var image = e.target;
        if($(image).hasClass('removeImage')) {
            var removeImage = $(image).prev().attr('src');
            var appendImage = $(image).prev().clone();
            $('.carouselImageD').val(removeImage);

            $(appendImage).addClass('mb-2');
            $('#delete_modal .modal-body > div:first-of-type').append($(appendImage));
        } else if($(image).hasClass('removeWelcomeMedia')) {
            var appendWelcomeMedia = $(image).prev().clone();
            $('.carouselImageD').val('welcomeMedia');

            $(appendWelcomeMedia).addClass('mb-2');
            $('#delete_modal .modal-body > div:first-of-type').append($(appendWelcomeMedia));
        }

        $('#delete_modal').addClass('d-block');
        setTimeout(function() {
            $('#delete_modal').addClass('show');
            $('body').addClass('modal-open').append("<div class='modal-backdrop fade show'></div>");
        }, 500);
    });

    //Search option box
    // $(".valueSearch ").keyup(function(e){
    // startSearch($(".valueSearch ").val());
    // });

    // Remove Modal
    $('body').on('click', '.close, .cancelBtn', function(e) {
        e.preventDefault();
        $('.modal').removeClass('show');

        setTimeout(function() {
            $('.modal').removeClass('d-block');
            $('body').removeClass('modal-open');
            $(".modal-backdrop.fade.show").remove();
        }, 500);
    });

    // Button toggle switch
    $('body').on("click", "button", function(e) {
        if(!$(this).hasClass('btn-primary') || !$(this).hasClass('btn-danger')) {
            if($(this).children().val() == "Y") {
                $(this).addClass('active btn-success').removeClass('btn-blue-grey').children().attr("checked", true);
                $(this).siblings().addClass('btn-blue-grey').removeClass('active btn-danger').children().removeAttr("checked");

                // If this is the contacts page, toggle the addresses select div visibility
                if($('.tenantProp').length > 0) {
                    $('.tenantProp').slideDown();
                }
            } else if($(this).children().val() == 'N') {
                $(this).addClass('active btn-danger').removeClass('btn-blue-grey').children().attr("checked", true);
                $(this).siblings().addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");

                // If this is the contacts page, toggle the addresses select div visibility
                if($('.tenantProp').length > 0) {
                    $('.tenantProp').slideUp();
                }
            }
        }
    });

    // Show Testimonial Switch
    $('body').on("click", ".showTestimonial", function(e) {
        e.preventDefault();
        if($(this).hasClass('showTestimonial')) {
            if($(this).hasClass('activeYes')) {
                $(this).addClass('active btn-success').removeClass('btn-blue-grey').children().attr("checked", true);
                $('.activeNo').removeClass('active btn-danger').addClass('btn-blue-grey').children().removeAttr("checked");
                $('.noUnderConstr').addClass('btn-danger active').removeClass('btn-blue-grey').children().attr("checked", true);
                $('.activeUnderConstr').addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");
            } else if($(this).hasClass('activeNo')) {
                $('.activeYes').addClass('btn-blue-grey').removeClass('active btn-success').children().removeAttr("checked");
                $('.activeNo').removeClass('btn-blue-grey').addClass('active btn-danger').children().attr("checked", true);
            } else {
                console.log('Here');
            }
        }
    });

    // Open/Closed Request Toggle
    $('body').on("click", ".requestBtn", function(e) {
        e.preventDefault();

        if($(this).hasClass('openRequestBtn')) {
            $(this).addClass('btn-light-green').removeClass('btn-outline-orange');
            $('.closedRequestBtn').removeClass('btn-light-green').addClass('btn-outline-orange');
            $('#open_request').removeClass('d-none');
            $('#completed_request').addClass('d-none');
        } else if($(this).hasClass('closedRequestBtn')) {
            $(this).addClass('btn-light-green').removeClass('btn-outline-orange');
            $('.openRequestBtn').removeClass('btn-light-green').addClass('btn-outline-orange');
            $('#open_request').addClass('d-none');
            $('#completed_request').removeClass('d-none');
        } else {
            console.log('Something went wrong!');
        }
    });

    // Scroll through calendars
    $('body').on('click', '.calendarMonth li.prev, .calendarMonth li.next', function() {
        var showingCalendarMonth = $(this).parent().parent().parent();

        if($(this).hasClass('next')) {
            if($(showingCalendarMonth).next().hasClass('calendarMonth')) {
                // Hide current calendar month
                $(showingCalendarMonth).hide();
                $(showingCalendarMonth).next().show();
            } else {
                toastr.error("No calendar months listed for next year", "Uh Ohh!!!", {showMethod: 'slideDown'});
            }
        } else {
            if($(showingCalendarMonth).prev().hasClass('calendarMonth')) {
                // Hide current calendar month
                $(showingCalendarMonth).hide();
                $(showingCalendarMonth).prev().show();
            } else {
                toastr.error("No calendar months listed for previous year", "Uh Ohh!!!", {showMethod: 'slideDown'});
            }
        }
    });

    // Change the default property image
    $('body').on('click', '.makeDefault', function() {
        var image = $(this).prev().prev().find('input');

        defaultPropImage(image);
    });

    // Click on input button when user goes to change
    // contact picture
    $('body').on('click', '.contactImg button', function(e) {
        e.preventDefault();
        $('.contactImg input').click();
    });

    // Call function for file preview when uploading
    // new contact image
    $('.contactImg input').change(function () {
        contactImgPreview(this);
        fileLoaded(this);
    });

    // Call function for file preview when uploading
    // new images to properties page
    $("#upload_photo_input").change(function () {
        filePreview(this);
        fileLoaded(this);
    });

    // Change the background color of submit button when sending
    // contact an email
    $("body").on('change', '.contactEmail #email_body textarea, .contactEmail #email_subject input', function () {
        var subject = $('.contactEmail #email_body textarea');
        var body = $('.contactEmail #email_subject input');
        if($(subject).val() != '' && $(body).val() != '') {
            $('[name="send_email"]').removeClass('lighten-5').addClass('dakren-3 active');
        };
    });

    // Get all property showings for selected date
    $("body").on('click', '.propShowings', function(e) {
        getShowings($(this).children().attr('id'));
    });

    // Upload new image for the current reunion
    $('body').on('click', 'button.resetCounterBtn', function() {
        event.preventDefault();

        $.ajax({
            url: "/reset_count",
            method: "POST",
            contentType: false,
            processData: false,
            cache: false,

            success: function(data) {
                var d = new Date();
                // Display a success toast
                toastr.success(data);
                $('.settingsCounter').text('0');
                $('.settingsCounterDate').text(d.toDateString());
            },
        });

        return false;
    });
});

//Check to see if the file has been loaded
//If so then remove modal
function fileLoaded(input) {
    setInterval(function() {
        if($('.imgPreview').length == input.files.length) {
            $('.loadingSpinner, .modal-backdrop')
                .css({'display' : 'none'})
                .removeClass('show')
                .addClass('hide');
            $('body')
                .removeClass('modal-open');
        }
    }, 1000);
}

// Preview images before being uploaded on images page and new location page
function filePreview(input) {
    $('.loadingSpinner').find('p').text('Adding Image/Video').ready(function() {
        $('.loadingSpinner').modal('show');
    });

    if(input.files && input.files[0]) {
        if(input.files.length > 1) {
            var imgCount = input.files.length
            $('.imgPreview').parent().remove();

            for(x=0; x < imgCount; x++) {
                if($('.uploadsView').length < 1) {
                    if(input.files[x].type.indexOf('video') != -1) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('<div class="d-block mx-auto mb-2 d-sm-inline-block" style="height:250px; width:250px; position:relative"><video controls class="imgPreview" style="max-height:250px;"><source src="' + e.target.result + '" /></video></div>').appendTo($('.currentCarImageDiv').find('.row'));
                        }
                        reader.readAsDataURL(input.files[x]);
                    } else {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('<div class="col-4 my-1"><img class="imgPreview img-thumbnail h-100 w-100" src="' + e.target.result + '"/></div>').appendTo($('.currentCarImageDiv').find('.row'));
                        }
                        reader.readAsDataURL(input.files[x]);
                    }
                } else {
                    if(input.files[x].type.indexOf('video') != -1) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('<div class="col-6 my-1"><video controls class="imgPreview" style="max-height:250px;"><source src="' + e.target.result + '" /></video></div>').appendTo('.uploadsView');
                        }
                        reader.readAsDataURL(input.files[x]);
                    } else {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('<div class="col-4 my-1"><img class="imgPreview img-thumbnail" src="' + e.target.result + '" width="450" height="300"/></div>').appendTo($('.uploadsView').find('.row'));
                        }
                        reader.readAsDataURL(input.files[x]);
                    }
                }
            }
        } else {
            var reader = new FileReader();
            $('.imgPreview').parent().remove();

            if($('.uploadsView').length < 1) {
                if(input.files[0].type.indexOf('video') != -1) {
                    reader.onload = function (e) {
                        $('<div class="d-block mx-auto mb-2 d-sm-inline-block" style="height:250px; width:250px; position:relative"><video controls class="imgPreview" style="max-height:250px;"><source src="' + e.target.result + '" /></video></div>').insertAfter('.currentCarImageDiv:last-of-type');
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    reader.onload = function (e) {
                        $('<div class="col-4 my-1"><img class="imgPreview img-thumbnail h-100 w-100" src="' + e.target.result + '"/></div>').appendTo($('.currentCarImageDiv').find('.row'));
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            } else {
                if(input.files[0].type.indexOf('video') != -1) {
                    reader.onload = function (e) {
                        $('<div class="col-6 my-1"><video controls class="imgPreview" style="max-height:250px;"><source src="' + e.target.result + '" /></video></div>').appendTo('.uploadsView');
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    reader.onload = function (e) {
                        $('<div class="col-4 my-1"><img class="imgPreview img-thumbnail" src="' + e.target.result + '" width="450" height="300"/></div>').appendTo($('.uploadsView').find('.row'));
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }
    }
}

// Preview contact image before uploading
function contactImgPreview(input) {
    var backdrop = '<div class="modal-backdrop show fade"></div>';
    $(backdrop).appendTo('body');
    $('.loadingSpinner')
        .css({'display' : 'block'})
        .addClass('show')
        .removeClass('hide')
        .find('p')
        .text('Adding Image/Video');
    $('body')
        .addClass('modal-open');

    var reader = new FileReader();

    reader.onload = function (e) {
        $('.contactImg img').attr('src', e.target.result).addClass('imgPreview');
    }
    reader.readAsDataURL(input.files[0]);
}

// Fill delete modal
function deleteModalUpdate(button) {
    var new_info = $(button).parents('div.modal-row');
    var form_info = $(button).attr('id').split('_');
    var form_controller = form_info[0]  === 'consults' ? 'consults' : form_info[0].replace('consult', 'consult_').toLocaleLowerCase();
    var form_edit_id = form_info[1];

    console.log(new_info);
    console.log(form_info);
    console.log(form_controller);
    console.log(form_edit_id);

    // Remove any previous information
    $('#delete_modal').find('.newModalContent').remove();

    // Update Delete Modal Form
    $('#delete_modal').find('.modal-body-form').attr('action', location.origin + '/' + form_controller + '/' + form_edit_id);

    // Update Delete Modal Info
    $('#delete_modal').find('.modal-body-text').append(new_info.find('.newModalContent').clone());

    // Show Delete Modal
    // $('#delete_modal').modal('show');
}

// Fill confirm modal
function confirmModalUpdate(button) {
    var new_info = $(button).parents('div.modal-row');
    var form_info = $(button).attr('id').split('_');
    var form_controller = form_info[0];
    var form_edit_id = form_info[1];

    // Remove any previous information
    $('#confirm_modal').find('.newModalContent').remove();

    // Update Confirm Modal Form
    $('#confirm_modal').find('.modal-body-form').attr('action', location.origin + '/' + form_controller + '/' + form_edit_id);

    // Update Confirm Modal Info
    $('#confirm_modal').find('.modal-body-text').append(new_info.find('.newModalContent').clone());

    // Show Confirm Modal
    // $('#delete_modal').modal('show');
}

// Filter members with search input
// Check text to see if it matches the search criteria being entered
function startSearch(searchVal) {
    var searchList = $('.fileList, .contactList, .propertyList');
    var searchCriteria = searchVal.toLowerCase();
    var foundResults = 0;
    $(searchList).removeClass("matches");
    $('.noSearchResults').remove();

    if(searchCriteria != "") {
        $(searchList).each(function(event){
            var dataString = $(this).find('h1').text().toLowerCase();

            if(dataString.includes(searchCriteria)) {
                $(this).addClass("matches");
                $(this).show();
                $(this).next().show();
                foundResults++;
            } else if(!dataString.includes(searchCriteria)) {
                $(this).next().hide();
                $(this).hide();
            }
        });

        // If all rows are hidden, then add a row saying no results found
        if(foundResults == 0) {
            $('<tr class="noSearchResults"><td>No Results Found</td></tr>').appendTo($('table.table tbody'));
        }
    } else {
        $(searchList).each(function(event){
            $(this).show();
            $(this).next().show();
        });
    }
}

// Initialize tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

// MDB Lightbox Init
$(function () {
    $("#mdb-lightbox-ui").load("/addons/mdb-lightbox-ui.html");
});

/* init Jarallax */
jarallax(document.querySelectorAll('.jarallax'));

jarallax(document.querySelectorAll('.jarallax-keep-img'), {
    keepImg: true,
});