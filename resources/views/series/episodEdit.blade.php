<div class="modal-content">
    <div class="modal-title">
        <h4>Edit Episode</h4>
        <div class="title-line"></div>
    </div>
    <form id="episodEditForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $target->id }}">

        <div class="form-group margin-top-20">
            <select name="series_id" id="seriesType" class="form-control create-form">
                <option value="0">Select Series</option>
                @foreach($seriesList as $id=>$name)
                <?php 
                $selected = '';
                if($id == $target->series_id){
                    $selected = 'selected';
                }
                ?>
                <option value="{{$id}}" {{$selected}}>{{$name}}</option>
                @endforeach  
            </select>
        </div>

        <div class="form-group margin-top-20" id="seasonSelect">
            <select name="season_id" id="seasonType" class="form-control create-form">
                <option value="0">Select Season</option>
                @foreach($seasonList as $id=>$name)
                <?php 
                $selected = '';
                if($id == $target->season_id){
                    $selected = 'selected';
                }
                ?>
                <option value="{{$id}}" {{$selected}}>{{$name}}</option>
                @endforeach  
            </select>
        </div>


        <div class="form-group margin-top-20">
            <input name="name" type="text" class="form-control create-form" id="name" placeholder="Episode Name" value="{{ $target->name }}">
        </div>

        <div class="form-group margin-top-20">
            <input name="number" type="text" class="form-control create-form" id="number" placeholder="Episode Number (Ex: e1)" value="{{ $target->number }}">
        </div>

        {{-- <div class="file-upload-edit">
            <div class="image-upload-wrap-edit">
                <input value="" name="image" class="file-upload-input-edit" type='file' onchange="readURLEdit(this);" accept="image/*" />
                <div class="drag-text-edit text-center">
                    <span class="iconify" data-icon="bx:bx-image-alt"></span>
                    <span>Upload Image Or Drag Here</span>
                </div>
            </div>
            <div class="image-size-recomandation-edit display-none"><ul><li>Recomanded Image Size 200px*320px</li></ul></div>
            <div class="file-upload-content-edit">
                <div class="image-title-wrap-edit">
                    <img class="file-upload-image-edit" src="{{ URL::to('/') }}/uploads/series/{{ $target->image }}" alt="{{ $target->name }}" />
                    <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                        <span class="iconify" data-icon="akar-icons:cross"></span>
                    </button>
                </div>
            </div>
        </div> --}}

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="editEpisod">Update</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
