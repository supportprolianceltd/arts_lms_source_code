<script type="text/javascript">
    function changeTitleOfImageUploader(photoElem) {
        var fileName = $(photoElem).val().replace(/C:\\fakepath\\/i, '');
        $(photoElem).siblings('label').text(ellipsis(fileName));
        <?php $upload_max_filesize_kb = str_replace('m', '', strtolower(ini_get('upload_max_filesize'))) * 1024; ?>
        if ('<?php echo $upload_max_filesize_kb * 1024; ?>' <= photoElem.files[0].size) {
            error_notify('<?php echo get_phrase('Your server does not allow uploading files that large.') . ' ' . get_phrase("Your servers file upload limit is " . ($upload_max_filesize_kb / 1024) . 'MB'); ?>');
        }
    }

    function set_js_flashdata(url) {
        $.ajax({
            url: url,
            success: function() {}
        });
    }

    function togglePriceFields(elem) {
        if ($("#" + elem).is(':checked')) {
            $('.paid-course-stuffs').slideUp();
        } else
            $('.paid-course-stuffs').slideDown();
    }
</script>

<?php if ($page_name == 'courses-server-side') : ?>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#course-datatable-server-side').DataTable({
                responsive: true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo site_url(strtolower($this->session->userdata('role')) . '/get_courses') ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        selected_category_id: '<?php echo $selected_category_id; ?>',
                        selected_status: '<?php echo $selected_status ?>',
                        selected_instructor_id: '<?php echo $selected_instructor_id ?>',
                        selected_price: '<?php echo $selected_price ?>'
                    }
                },
                "columns": [{
                        "data": "#"
                    },
                    {
                        "data": "title"
                    },
                    {
                        "data": "category"
                    },
                    {
                        "data": "lesson_and_section"
                    },
                    {
                        "data": "enrolled_student"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "price"
                    },
                    {
                        "data": "actions"
                    },
                ]
            });
        });

        $(".server-side-select2").each(function() {
            var actionUrl = $(this).attr('action');
            $(this).select2({
                ajax: {
                    url: actionUrl,
                    dataType: 'json',
                    delay: 1000,
                    data: function(params) {
                        return {
                            searchVal: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    }
                },
                placeholder: 'Search here',
                minimumInputLength: 1,
            });
        });
    </script>
<?php endif; ?>

<script type="text/javascript">
    function refreshServersideTable(tableId) {
        $('#' + tableId).DataTable().ajax.reload();
    }

    function switch_language(language) {
        $.ajax({
            url: '<?php echo site_url('home/site_language'); ?>',
            type: 'post',
            data: {
                language: language
            },
            success: function(response) {
                setTimeout(function() {
                    location.reload();
                }, 500);
            }
        });
    }


    function div_add() {
        $.NotificationApp.send("<?php echo get_phrase('successfully'); ?>!", '<?php echo get_phrase('Div added to bottom ') ?>', "top-right", "rgba(0,0,0,0.2)", "info");

    }

    function div_remove() {
        $.NotificationApp.send("<?php echo get_phrase('successfully'); ?>!", '<?php echo get_phrase('Div has been deleted ') ?>', "top-right", "rgba(0,0,0,0.2)", "error");

    }
</script>

<!-- Google analytics -->
<?php if (!empty(get_settings('google_analytics_id'))) : ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_settings('google_analytics_id'); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', '<?php echo get_settings('google_analytics_id'); ?>');
    </script>
<?php endif; ?>
<!-- Ended Google analytics -->

<!-- Meta pixel -->
<?php if (!empty(get_settings('meta_pixel_id'))) : ?>
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?php echo get_settings('meta_pixel_id'); ?>');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo get_settings('meta_pixel_id'); ?>&ev=PageView&noscript=1" />
    </noscript>
<?php endif; ?>
<!-- Ended Meta pixel -->

<script type="text/javascript">
    function checkExpiryPeriodShortcut(e) {
        var expiryPeriodShortcut = $(e).val();
        if (expiryPeriodShortcut == 'lifetime') {
            $('#number_of_monthShortcut').slideUp();
        } else {
            $('#number_of_monthShortcut').slideDown();
        }
    }

    function checkExpiryPeriod(e) {
        var expiryPeriod = $(e).val();
        if (expiryPeriod == 'lifetime') {
            $('#number_of_month').slideUp();
        } else {
            $('#number_of_month').slideDown();
        }
    }



    function actionTo(url, type = "get", event) {
        //Start prepare get url to post value
        var jsonFormate = '{}';
        if (type == 'post') {
            let pieces = url.split(/[\s?]+/);
            let lastString = pieces[pieces.length - 1];
            jsonFormate = '{"' + lastString.replace('=', '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","').replace("=", '":"').replace("&", '","') + '"}';
        }
        jsonFormate = JSON.parse(jsonFormate);
        //End prepare get url to post value
        $.ajax({
            type: type,
            url: url,
            data: jsonFormate,
            success: function(response) {
                distributeServerResponse(response);
            }
        });

    }

    //Server response distribute
    function distributeServerResponse(response) {
        try {
            JSON.parse(response);
            var isValidJson = true;
        } catch (error) {
            var isValidJson = false;
        }
        if (isValidJson) {
            response = JSON.parse(response);
            //For reload after submission
            if (typeof response.reload != "undefined" && response.reload != 0) {
                location.reload();
            }

            //For redirect to another url
            if (typeof response.redirectTo != "undefined" && response.redirectTo != 0) {
                $(location).attr('href', response.redirectTo);
            }

            //for show a element
            if (typeof response.show != "undefined" && response.show != 0 && $(response.show).length) {
                $(response.show).css('display', 'inline-block');
            }
            //for hide a element
            if (typeof response.hide != "undefined" && response.hide != 0 && $(response.hide).length) {
                $(response.hide).hide();
            }
            //for fade in a element
            if (typeof response.fadeIn != "undefined" && response.fadeIn != 0 && $(response.fadeIn).length) {
                $(response.fadeIn).fadeIn();
            }
            //for fade out a element
            if (typeof response.fadeOut != "undefined" && response.fadeOut != 0 && $(response.fadeOut).length) {
                $(response.fadeOut).fadeOut();
            }

            //For adding a class
            if (typeof response.addClass != "undefined" && response.addClass != 0 && $(response.addClass.elem).length) {
                $(response.addClass.elem).addClass(response.addClass.content);
            }
            //For remove a class
            if (typeof response.removeClass != "undefined" && response.removeClass != 0 && $(response.removeClass.elem).length) {
                $(response.removeClass.elem).removeClass(response.removeClass.content);
            }
            //For toggle a class
            if (typeof response.toggleClass != "undefined" && response.toggleClass != 0 && $(response.toggleClass.elem).length) {
                $(response.toggleClass.elem).toggleClass(response.toggleClass.content);
            }

            //For showing error message
            if (typeof response.error != "undefined" && response.error != 0) {
                error_notify(response.error);
            }
            //For showing success message
            if (typeof response.success != "undefined" && response.success != 0) {
                success_notify(response.success);
            }

            //For replace texts in a specific element
            if (typeof response.text != "undefined" && response.text != 0 && $(response.text.elem).length) {
                $(response.text.elem).text(response.text.content);
            }
            //For replace elements in a specific element
            if (typeof response.html != "undefined" && response.html != 0 && $(response.html.elem).length) {
                $(response.html.elem).html(response.html.content);
            }
            //For replace elements in a specific element
            if (typeof response.load != "undefined" && response.load != 0 && $(response.load.elem).length) {
                $(response.load.elem).html(response.load.content);
            }
            //For replace elements with the selected DOM
            if (typeof response.replace != "undefined" && response.replace != 0 && $(response.replace.elem).length) {
                $(response.replace.elem).html(response.replace.content);
                $(response.replace.elem).replaceWith(response.replace.content);
            }
            //For appending elements
            if (typeof response.append != "undefined" && response.append != 0 && $(response.append.elem).length) {
                $(response.append.elem).append(response.append.content);
            }
            //Fo prepending elements
            if (typeof response.prepend != "undefined" && response.prepend != 0 && $(response.prepend.elem).length) {
                $(response.prepend.elem).prepend(response.prepend.content);
            }
            //For appending elements after a element
            if (typeof response.after != "undefined" && response.after != 0 && $(response.after.elem).length) {
                $(response.after.elem).after(response.after.content);
            }

            // Update the browser URL and add a new entry to the history
            if (typeof response.pushState != "undefined" && response.pushState != 0) {
                //history.pushState({}, response.pushState.title, response.pushState.url);
                const {
                    title,
                    url
                } = response.pushState;
                history.pushState({}, title, url);
            }

            if (typeof response.script != "undefined" && response.script != 0) {
                script
            }

            if (typeof response.run_function != "undefined" && response.run_function != 0) {
                window[response.run_function]();
            }
        }
    }
</script>





<!-- Newsletter sending start-->
<?php
$email_list = $this->db->where('status', 'pending')->or_where('status', 'faild')->get('newsletter_histories')->num_rows();
if ($email_list > 0) :
?>

    <script>
        var sendEmailNewsletter;
        sendEmailNewsletter = setInterval(function() {
            $.ajax({
                url: '<?php echo site_url('home/sendEmailToAssignedAddresses'); ?>',
                type: 'post',
                success: function(response) {

                    if ($('#newsletter_statistics').length > 0) {
                        $.ajax({
                            url: '<?php echo site_url('admin/newsletter_statistics'); ?>',
                            type: 'post',
                            success: function(responseHtml) {
                                $('#newsletter_statistics').html(responseHtml);
                            }
                        });
                    }

                    if (response == 'no_data_found') {
                        clearInterval(sendEmailNewsletter);
                    }
                }
            });
        }, 60000);
    </script>

<?php endif; ?>
<!-- Newsletter sending end-->

<script>
var a = $(".datatable-user-data-buttons").DataTable({
        lengthChange: !1,
        dom:'Blfrtip',
        buttons: [{extend:'copy'},{extend:'pdf'},{extend:'csv',exportOptions:{columns:[2,3,4,5,6,7]}},{extend:'excel',exportOptions:{columns:[2,3,4,5,6,7]}}],
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        }
    });
    var a = $(".datatable-buttons").DataTable({
        lengthChange: !1,
        buttons: ["copy", "print",'csv','pdf'],
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        }
    });

    $(".basic-datatable").DataTable({
        keys: !0,
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        }
    });
    </script>

<script>
$(document).ready(
    function(){
        $('.summer_note_ext_1').each(function () {
            initSummerNoteExt($(this));
        });
    }
);

function initSummerNoteExt($editor) {

    //const $editor = $(this);
    const shouldStrip = $editor.hasClass('summer_note_ext_strip');

    const callbacks = {
      onImageUpload: function(files) {
        console.log('files')
        for (let i = 0; i < files.length; i++) {
          const reader = new FileReader();
          reader.onload = function (e) {
            $editor.summernote('insertImage', e.target.result);
          };
          reader.readAsDataURL(files[i]);
        }
      }
    };

    if (shouldStrip) {
      callbacks.onPaste = function(e) {
        e.preventDefault();
        const clipboardData = (e.originalEvent || e).clipboardData || window.clipboardData;
        const text = clipboardData.getData('text/plain');
        const html = clipboardData.getData('text/html');

        // Handle pasted image files
        if (clipboardData.items) {
          for (let i = 0; i < clipboardData.items.length; i++) {
            const item = clipboardData.items[i];
            if (item.kind === 'file' && item.type.startsWith('image/')) {
              const file = item.getAsFile();
              const reader = new FileReader();
              reader.onload = function(e) {
                $editor.summernote('insertImage', e.target.result);
              };
              reader.readAsDataURL(file);
              return; // Process one image for simplicity
            }
          }
        }

        // Handle HTML or plain text
        if (html) {
          const tempDiv = document.createElement('div');
          tempDiv.innerHTML = html;
          const nodes = tempDiv.childNodes;
          nodes.forEach(node => {
            if (node.nodeType === Node.ELEMENT_NODE && node.tagName === 'IMG') {
              const src = node.getAttribute('src');
              if (src && src.startsWith('data:image/')) {
                $editor.summernote('insertImage', src);
              }
            } else {
              const textContent = node.textContent || '';
              if (textContent.trim()) {
                $editor.summernote('insertText', textContent);
              }
            }
          });
        } else {
          $editor.summernote('insertText', text);
        }
      };
    }

    $editor.summernote({
      height: 300,
      placeholder: 'Start typing or insert an image...',
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['picture', 'link', 'video', 'hr']],
        ['view', ['fullscreen', 'help']]
      ],
      callbacks: callbacks
    });
}
</script>
<script>
    items=document.querySelectorAll('.rating').forEach((item)=>{
    _item_average_rating=item.getAttribute('_average_rate');
    if(!isNaN(_item_average_rating)){
        load_rating(_item_average_rating,item);
    }
});

function load_rating(rate,item=null){
    reactive=item==null||item==undefined?false:item.getAttribute('reactive')=='reactive';
    var num_rating=5;
    if(isNaN(rate)) rate=0;
    var ri_class=' star-on text-warning';
    var ri='';
    for(i=0;i<num_rating;i++){
        if(i==rate) ri_class=' star-off';
        index=i+1;
        ri+="<i class='fa fa-star"+ri_class+"'";
        if(reactive) ri+=" onclick='set_product_rating("+item._ref+","+index+")'"
        ri+="></i>";
    }
    //console.log(rate);
    if(item!=null) item.innerHTML=ri;
    else document.getElementById('stars').innerHTML=ri;
}
</script>