<section class="content">
    <div class="row">
        <div class="box box-primary">
            <form action="" method="POST" id="create-attribute-form">
                @csrf
                <div class="box-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">(*)</span></label>
                            <input type="text" class="form-control" name="attributename" placeholder="Name ......">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="attributedescription" rows="3"
                                    placeholder="Enter ..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="" class="btn btn-danger" id="back-index"><i class="fa fa-undo"></i> Trở Lại</a>
                    {{-- <button type="submit" class="btn btn-danger" id="back-index"><i class="fa fa-undo"></i> Trở lại</button> --}}
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</section>
