@extends('administrator.layouts.layouts')
@section('content')

 <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                   
                    </h3>
                </div>
                <div class="panel-body">
                    @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{ session()->get('message') }}</strong>
                        </div>
                    @endif
                    <div class="row">
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs" id="campaign-tab">
                                    <li class="active">
                                        <a href="#property" data-toggle="tab" aria-expanded="false">
                                            <span class="visible-xs"><i class="fa fa-home"></i></span>
                                            <span class="hidden-xs">Property</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#idea" data-toggle="tab" aria-expanded="true" disabled="">
                                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                                            <span class="hidden-xs">Gallery</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#team" data-toggle="tab" aria-expanded="true">
                                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                                            <span class="hidden-xs">Video</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#capacities" data-toggle="tab" aria-expanded="true">
                                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                                            <span class="hidden-xs">Capacities</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#owner" data-toggle="tab" aria-expanded="true">
                                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                                            <span class="hidden-xs">Owner Detail</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#client" data-toggle="tab" aria-expanded="true">
                                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                                            <span class="hidden-xs">Client Detail</span>
                                        </a>
                                    </li>
                                   
                                </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="property">
                                        @include('administrator.property.tab.pro')
                                        </div>
                                        <div class="tab-pane" id="idea">
                                            @include('administrator.property.tab.gallery')
                                        </div>
                                        <div class="tab-pane" id="team">
                                            @include('administrator.property.tab.video')
                                        </div>
                                        <div class="tab-pane" id="capacities">
                                            @include('administrator.property.tab.capacity')
                                        </div>
                                        <div class="tab-pane" id="owner">
                                            @include('administrator.property.tab.owner')
                                        </div>
                                        <div class="tab-pane" id="client">
                                            @include('administrator.property.tab.client')
                                        </div>
                                    </div>

                            </div>
                        </div>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->

    </div> <!-- End row -->
@stop

@section('scripts')
    <script type="text/javascript">
       $(document).ready(function(){
        $(".date").datepicker({
                format: 'yyyy-mm-dd'
            });

        $('select[name="pro_id"]').on('change', function() {
        var proid = $(this).val();
        if(proid) {
            $.ajax({
                url: '/admin/province-distric/'+proid,
                type: "get",
                dataType: "json",
                success:function(data) {
                    console.log(data);
                    $('select[name="destric"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="destric"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });

                }
            });
        }else{
            $('select[name="subcat"]').empty();
        }
    });

        // store the currently selected tab in the hash value
            $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
                var id = $(e.target).attr("href").substr(1);
                window.location.hash = id;
            });

            // on load of the page: switch to the currently selected tab
            var hash = window.location.hash;
            $('#campaign-tab a[href="' + hash + '"]').tab('show');
            
         $('.content_textarear').summernote({
                  height: 250,                 // set editor height
                  minHeight: null,             // set minimum height of editor
                  maxHeight: null,             // set maximum height of editor
                  focus: true                  // set focus to editable area after initializing summernote
            });
                $("#wizard-picture").change(function(){
                readURL(this,'blah');
                });
                $("#frm-partner").submit(function(e) {
                e.preventDefault();
                }).validate({
                rules: {
                title_en: "required",
                logo: {
                extension: "jpg,jpeg,png,gif",
                },
                
                },
                // Specify validation error messages
                messages: {
                title_en: "Please enter title",
                logo: {
                extension: "File must be types: JPG/GIF/PNG/PDF",
                }
                },
                submitHandler: function(form) {
                form.submit();
                }
                });
                });
                $(".drag-img").click(function(){
                $("#file-image").trigger('click');
                });
                function filePreview(input,changeImage) {
                if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                $('#'+changeImage).attr('src',e.target.result);
                //$('#uploadForm + embed').remove();
                //$('#uploadForm').after('<embed src="'+e.target.result+'" width="450" height="300">');
                }
                reader.readAsDataURL(input.files[0]);
                }
                }
                $("body").on("click",".remove-pic",function(){
                $(this).parents('#table-image tr td').remove();
                });
                $(".drag-img").on('dragenter', function (e){
                e.preventDefault();
                });
                $(".drag-img").on('dragover', function (e){
                e.preventDefault();
                });
                $(".drag-img").on('drop', function (e){
                e.preventDefault();
                var image = e.originalEvent.dataTransfer.files;
                var formData = new FormData($('#photos-uploader')[0]);
                var token = "{{csrf_token()}}";
                var row_count = $("#table-image tr td").length;
                var url_img = "{{asset('/uploads/product/photoalbum/')}}";
                for(var i = 0; i<image.length;i++){
                var check = checkIsImage(image[i]);
                if(check){
                formData.append('image[]',image[i]);
                }else{
                alert('Please select image file.');
                return false;
                }
                }
                if(image.length > 10 ){
                alert('Upload Maximum 10 photos!');
                return false;
                }else {
                if ((parseInt(row_count) + parseInt(image.length)) > 10) {
                alert('Upload Maximum 10 photos!');
                return false;
                }
                $.ajax({
                url: "",
                headers: {
                'X-CSRF-TOKEN': token
                },
                type: "POST",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                console.log(data);
                for (var i = 0; i < data.length; i++) {
                $("#table-image tr").prepend(
                "<td><div class='img-show'>" +
                    "<input type='hidden' name='image_name[]' id='image_name' value='" + data[i] + "'>" +
                    "<img src='"+url_img+'/'+data[i]+"' class='image-drop'>" +
                "<i class='fa fa-remove fa-absolute remove-pic'></i></div></td>"
                );
                }
                }
                });
                }
                });
                $("#file-image").change(function(){
                var formData = new FormData($('#photos-uploader')[0]);
                var count = $(this)[0].files.length;
                var token = "{{csrf_token()}}";
                var row_count = $("#table-image tr td").length;
                var image = this.files[0];
                var check = checkIsImage(image);
                var url_img = "{{asset('/uploads/product/photoalbum/')}}";
                
                if(!check){
                alert('Please select image file.');
                return false;
                }
                if(count > 10 ){
                alert('Upload Maximum 10 photos!');
                return false;
                }else{
                if((parseInt(row_count)+parseInt(count))>10){
                alert('Upload Maximum 10 photos!');
                return false;
                }
                $.ajax({
                url: "",
                headers: {
                'X-CSRF-TOKEN' : token},
                type: "POST",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                console.log(data);
                for(var i = 0; i<data.length;i++){
                $("#table-image tr").prepend(
                "<td><div class='img-show'>" +
                    "<input type='hidden' name='image_name[]' id='image_name' value='"+data[i]+"'>"+
                    "<img src='"+url_img+'/'+data[i]+"' class='image-drop'>" +
                "<i class='fa fa-remove fa-absolute remove-pic'></i></div></td>"
                );
                }
                }
                });
                }
                });
                $("#save-image").click(function(){
                var formData = new FormData($('#photos-uploader')[0]);
                var token = "{{csrf_token()}}";
                $.ajax({
                url: "",
                headers: {
                'X-CSRF-TOKEN': token
                },
                type: "POST",
                // dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function (image_name) {
                   
                    if (image_name == 'successfully') {
                         swal({
                                title: "Done!",
                                text: "You have success to create Past Events!!",
                                type: "success"
                            }, function() {
                                location.reload();
                            });
                    }
                // alert(image_name);
           
                $("#table-image tr").html('');
                }
                });
                });
             $("#delete_selectd").click(function(){
                    var check_select = $(".listing__list input:checkbox:checked").map(function(){
                    return $(this).val();
                    }).get();
                    if(check_select==''){
                    alert('Please select picture!');
                    return false;
                    }
                    swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    showLoaderOnConfirm: true,
                    }, function (isConfirm) {
                    if (!isConfirm) return;
                    $.ajax({
                    url: "",
                    type: "GET",
                    data: {id:check_select},
                    success: function () {
                    swal("Done!", "It was succesfully deleted!", "success");
                    location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error deleting!", "Please try again", "error");
                    }
                    });
                    });
                    });
                function checkIsImage(file, callback){
                var image_match = ["image/jpeg", "image/png", "image/jpg"];
                var imagefile = file.type;
                // console.log(imagefile);
                imagefile = imagefile.toLowerCase();
                if(imagefile == image_match[0] || imagefile == image_match[1] || imagefile == image_match[2]){
                return true;
                }else{
                return false;
                }
                }
      function SearchBox() {
            var searchTextBox = $('<input id="searchInput" class="form-control" type="text" placeholder="Enter a location">');

            var div = $('#text-se-map')
                    .html(searchTextBox);

            return div;
        }
        var geocoder = new google.maps.Geocoder();
        var marker;
        var icon = "{{asset('images/marker/default.png')}}";
        function initMap() {
            var latitude,longitude;

            if($("#lat").val()=='' && $("#lng").val()==''){
                latitude = 11.5500;
                longitude = 104.9167;
            }else{
                latitude = $("#lat").val();
                longitude = $("#lng").val();
            }
            geocoder = new google.maps.Geocoder();
            var LatLng = new google.maps.LatLng(latitude, longitude);
            document.getElementById('lat').value = latitude;
            document.getElementById('lng').value = longitude;
            var mapProp = {
                center: LatLng,
                zoom:12,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            var map=new google.maps.Map(document.getElementById("map"), mapProp);
            marker = new google.maps.Marker({
                position: LatLng,
                map: map,
                icon: icon,
                title: 'Maker',
                draggable: true
            });
            var input = document.getElementById('searchInput');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                    $("#lat").val(place.geometry.location.lat());
                    $("#lng").val(place.geometry.location.lng());
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);  // Why 17? Because it looks good.
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
            });


            google.maps.event.addListener(marker, 'dragend', function() {
                $("#lat").val(marker.getPosition().lat());
                $("#lng").val(marker.getPosition().lng());
                geocodePosition(marker.getPosition());
            });


        }
        $(document).ready(function(){
            google.maps.event.addDomListener(window, 'load', initMap)
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                SearchBox();
                google.maps.event.trigger( initMap());

            });
        });
        function geocodePosition(pos) {

            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                if (responses && responses.length > 0) {
                    marker.formatted_address = responses[0].formatted_address;
                } else {
                    marker.formatted_address = 'Cannot determine address at this location.';
                }
                document.getElementById("searchInput").value = marker.formatted_address;
            });
        }

    </script>
@stop