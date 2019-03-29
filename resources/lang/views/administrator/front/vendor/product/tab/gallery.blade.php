<div class="panel-body">
    <div class=" form">
        <form id="photos-uploader" class="form-horizontal" enctype="multipart/form-data">
            <input name="pro_id" type="hidden" value="{!!$product?$product->id : ''!!}">
            {{csrf_field()}}
            <div class="row" style="margin-top: 25px;">
             <div class="listing__list js-photos-list" id="filter-album">
                <div class="drag-img">
                    <i class="fa fa-plus-circle fa-color" aria-hidden="true" id="btn-pop-img"></i><br>
                    <span>DROP FILES HERE TO UPLOAD</span>
                </div>
                <input type="file" name="image[]" class="v-hidden"  id="file-image" multiple="multiple" accept="image/*">
         
                <div class="row" style="margin-top: 25px;">
                       @if(!$photos->isEmpty())
                    @foreach($photos  as $photo)
                    <div class="col-sm-4">
                        <div class="img_pro">
                            <div class="check_image">
                                <input type="checkbox" name="check_pic[]" id="check_pic" class="check_pho" value="{{$photo->id}}">
                            </div>
                            <div class="icon_pro">
                                <i class="fa fa-arrows"></i>
                            </div>
                            <a href='{{asset("/uploads/product/photoalbum/$photo->path")}}' data-size="1168x550" class="item-photo item-photo--static js-gallery-item">
                                <img src='{{asset("/uploads/product/photoalbum/$photo->path")}}' alt="" width="100%">
                            </a>
                            <input type="hidden" class="form-control picture-title" value="{{($photo->title!='')?$photo->title:''}}" data-id = "{{$photo->id}}">
                            <label class="title-success" id="title-success-{{$photo->id}}"></label>
                            <span class="full_image">FULL SCREEN</span>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <table id="table-image">
                        <tr>
                        </tr>
                    </table>
                </div>
                <div class="row margin-top-10 margin-left-10">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="button" id="save-image" class="btn btn-success">Save changes</button>
                            <button type="button" id="delete_selectd" class="btn btn-success">Delete selected</button>
                    </div>
                  </div>  
                </div>
            </div>
        </form>      
    </div> <!-- .form -->
</div> <!-- panel-body -->