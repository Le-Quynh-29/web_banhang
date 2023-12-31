<div class="modal fade" id="modal-confirm" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $content }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-modal-save">{{ $textBtnSave }}</button>
                <button type="button" class="btn btn-secondary" id="btn-modal-cancel"
                        data-coreui-dismiss="modal">{{ $textBtnCancel }}</button>
            </div>
        </div>
    </div>
</div>
