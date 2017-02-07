<div class="modal-dialog" role="document">
    <form role="form" action="{{URL::to('/admin/event/calendarModalSave')}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Yeni Randevu</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group">
                        <label for="start_date">Başlangıç Tarihi</label>
                        <input class="form-control" type="date" name="start_time">
                    </div>
                    <div class="form-group">
                        <label for="finish_date">Bitiş Tarihi</label>
                        <input class="form-control" type="date" name="end_time">
                    </div>
                    <div class="form-group">
                        <label for="detail">Başlık</label>
                        <input class="form-control" type="text" name="title" id="title" onkeyup="titleBtn()" placeholder="Başlık En az 5 harf">
                    </div>
                </div><!-- /.box-body -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                <button id="randevuSaveBtn" type="submit" class="btn btn-primary" disabled>Randevuyu Ekle</button>
            </div>
        </div><!-- /.modal-content -->
    </form>
</div><!-- /.modal-dialog -->