<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=p1p9mmswl4ky9g4tc92i72m8ql0udlurva2jymfgfbfwztzv"></script>
<script>
    var selector = '.tinyEditor';
    // tinymce.init({
    //     selector: selector,
    //     height: 200,
    //     theme: 'modern',
    //     image_advtab: true,
    //     plugins: 'image code print preview fullpage powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
    //     toolbar: 'undo redo | image code | formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
    //
    //     // without images_upload_url set, Upload tab won't show up
    //     images_upload_url: 'UploadContoller@upload',
    //
    //     // override default upload handler to simulate successful upload
    //     images_upload_handler: function (blobInfo, success, failure) {
    //         var xhr, formData;
    //
    //         xhr = new XMLHttpRequest();
    //         xhr.withCredentials = false;
    //         xhr.open('POST', 'upload.php');
    //
    //         xhr.onload = function() {
    //             var json;
    //
    //             if (xhr.status != 200) {
    //                 failure('HTTP Error: ' + xhr.status);
    //                 return;
    //             }
    //
    //             json = JSON.parse(xhr.responseText);
    //
    //             if (!json || typeof json.location != 'string') {
    //                 failure('Invalid JSON: ' + xhr.responseText);
    //                 return;
    //             }
    //
    //             success(json.location);
    //         };
    //
    //         formData = new FormData();
    //         formData.append('file', blobInfo.blob(), blobInfo.filename());
    //
    //         xhr.send(formData);
    //     },
    // });

    var editor_config = {
        path_absolute : "/",
        height: 200,
        selector: selector,
        branding: false,
        image_advtab: true,
        plugins: [
            "advlist autolink lists link image imagetools charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media code",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };

    tinymce.init(editor_config);
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
{{--<script>--}}
    {{--$(document).ready(function(){--}}
        {{--setInterval(function(){ $('#mceu_41').hide(); }, 100);--}}
    {{--});--}}
{{--</script>--}}
