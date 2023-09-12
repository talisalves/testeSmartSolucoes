<div class="modal inmodal" id="modal-agendamemnto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">Novo Compromisso</h4>
            </div>
            <form action="" id="form-add-appointment">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Nome</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnSubmit">Salvar</button>
                    <button type="button" class="btn btn-primary" id="btnUpdate">Atualizar</button>
                    <button type="button" class="btn btn-danger" id="btnRemover">Remover</button>
                    <br>
                    <input type="checkbox" id="status"> Compromisso ativo
                </div>

                <input type="hidden" name="id" id="id" class="form-control">
            </form>
        </div>
    </div>
</div>