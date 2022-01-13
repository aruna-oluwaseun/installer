$(document).ready(function() {

    // Show tab on page load
    if($(location).attr('hash').length)  {
        $('.nav-tabs li a[href="'+$(location).attr('hash')+'"]').trigger('click');
    }

    // Postcode lookup
    $(document).on('click','#postcode-btn', function() {
        var button = $(this);
        var text = button.text();
        button.text('...please wait');
        var container = $(this).parents('.address-container');

        var postcode = container.find('.find-postcode').val();
        var result_box = container.find('.show-addresses');

        if(postcode != '')
        {
            $.ajax({
                method: 'GET',
                url : '/fetch-postcode',
                data : 'postcode=' + postcode,
                success : function(response) {
                    if(response.success)
                    {
                        result_box.find('label').text(response.result.length + ' Addresses found');
                        var select = '<select class="form-control" id="change-address">';
                        $(response.result).each(function(key, result) {
                            console.log($(this).postcode + ' OR ' + result.postcode)
                            select += '<option data-organisation="' + result.organisation_name + '" data-line-1="' + result.line_1 + '" data-line-2="' + result.line_2 + '" data-line-3="' + result.line_3 + '" data-county="' + result.county + '" data-city="' + result.district + '" data-country="' + result.country + '" data-lat="' + result.latitude + '" data-lng="' + result.longitude + '" data-postcode="' + result.postcode + '" value="' + result.postcode + '">' + result.line_1 + ' ' + result.line_2 + '</option>';
                        });
                        select += '</option>'

                        result_box.find('.form-control-wrap').html(select);
                        result_box.find('.form-control-wrap select').select2({
                            theme: "bootstrap"
                        });
                        result_box.show();

                        button.text(text);
                    }
                    else
                    {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.error ? response.error : 'An error occurred, please re-fresh and try again.',
                            //footer: '<a href>Why do I have this issue?</a>'
                        });
                    }
                },
                error: function(XHR, textStatus, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred, you session may have expired, please re-fresh and try again.',
                        //footer: '<a href>Why do I have this issue?</a>'
                    });
                    button.text(text);
                }
            });
        }
        else
        {
            button.text(text);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You need to enter a postcode.',
                //footer: '<a href>Why do I have this issue?</a>'
            });
        }

    });


    $(document).on('change', '.show-addresses', function() {
        var container = $(this).parents('.address-container');
        var selected = $(this).find(':selected');

        container.find('.title').val(selected.data('organisation'));
        container.find('.line1').val(selected.data('line-1'));
        container.find('.line2').val(selected.data('line-2'));
        container.find('.line3').val(selected.data('line-3'));
        container.find('.city').val(selected.data('city'));
        container.find('.postcode').val(selected.data('postcode'));
        container.find('.county').val(selected.data('county'));
        container.find('.lat').val(selected.data('lat'));
        container.find('.lng').val(selected.data('lng'));

    });


    // Delete via Link or Ajax
    $(document).on('click','.destroy-btn', function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var async = $(this).data('async') ? $(this).data('async') : false;
        var self = $(this);

        Swal.fire({
            title: 'Are you sure you want remove this item?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove it!'

        }).then(function (action) {
            if( action.isConfirmed ) {
                // send via ajax
                if(async) {
                    $.ajax({
                        method : 'get',
                        url: url,
                        success: function(response) {
                            console.log(response);
                            if(response.success)
                            {
                                if( self.parents('.remove-target').length) {
                                    self.parents('.remove-target').remove();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Item removed.',
                                        //footer: '<a href>Why do I have this issue?</a>'
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Item removed, please re-fresh for the item to removed from your view.',
                                        //footer: '<a href>Why do I have this issue?</a>'
                                    });
                                }
                            }
                            else
                            {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message ? response.message : 'An error occurred remove this item please re-fresh and try again.',
                                    //footer: '<a href>Why do I have this issue?</a>'
                                });
                            }
                        },
                        error: function(XHR, textStatus, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'An error occurred removing your item, please re-fresh your page and try again.',
                                //footer: '<a href>Why do I have this issue?</a>'
                            });
                        }
                    });

                } else {
                    window.location = url;
                }
            }

        })
    });

    // Delete Http
    $(document).on('click','.destroy-resource', function(event) {
        event.preventDefault();
        var self = $(this);
        var form = '#' + self.attr('form');
        var message = self.data('message') ? self.data('message') : 'You won\'t be able to revert this!';

        Swal.fire({
            title: 'Are you sure you want remove this item?',
            text: message ? message : "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove it!'

        }).then(function (action) {
            if( action.isConfirmed ) {
                // send via ajax
                $(form).submit();
            }

        })
    });

    // summernote editor
    if($('.summernote-single').length) {

        $('.summernote-single').each(function(key,value)
        {
            var placeholder = $(this).data('placeholder') ? $('.summernote-single').data('placeholder') : 'Description';

            $(this).summernote({
                placeholder: placeholder,
                tabsize: 2,
                height: 120,
                toolbar: [['style', ['style']], ['font', ['bold', 'underline', 'clear']], ['para', ['ul', 'ol', 'paragraph']], ['table', ['table']]] //, ['view', ['fullscreen']]
            });
        });
    }

    $('#profile ul, #services ul').each(function() {
        $(this).addClass('list-marked');
    });

    $('#profile ol, #services ol').each(function() {
        $(this).addClass('list-ordered');
    });


    $(document).on('click','.record-click', function() {
        var id = $(this).data('id');
        var type = $(this).data('type');

        $.ajax({
            method: 'get',
            url: '/record-stat',
            data: 'company_id=' + id + '&type=' + type,
            success : function(response)
            {
                if(response.success) {

                } else {
                    console.log('Request sent but error logging stat')
                }
            },
            error : function()
            {
                console.log('Error logging stat');
            }
        })
    });
});

function debug(obj)
{
    var seen = [];

    JSON.stringify(obj, function(key, val) {
        if (val != null && typeof val == "object") {
            if (seen.indexOf(val) >= 0) {
                return;
            }
            seen.push(val);
        }
        return val;
    });

    console.log(seen);
}
