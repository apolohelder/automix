
<div class="modal fade" id="contatoWhat" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
            <div class="modal-content">
                  <div class="modal-header">
                        <h5 class="modal-title text-center w-100">
                              <i class="fa fa-whatsapp text-success mr-2" aria-hidden="true"></i> Fale Conosco
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                              <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                  <form method="post" action="<?php echo URL::getBase() ?>modulos/enviaremail.php">
                       
                        <div class="modal-body">
                              <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input required type="text" class="form-control" id="nome" name="nome" placeholder="Nome e sobrenome">
                              </div>
                              <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input required type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com">
                              </div>
                              <div class="form-group">
                                    <label for="phone">Telefone</label>
                                    <input required type="tel" class="form-control" id="phone" name="phone" placeholder="Telefone">
                              </div>
                              <div class="form-group">
                                    <label for="assunto">Assunto</label>
                                    <input required type="text" class="form-control" id="assunto" name="assunto">
                              </div>
                              <div class="form-group">
                                    <label for="mensagem">Deixe sua mensagem</label>
                                    <textarea class="form-control" id="mensagem" rows="3"></textarea>
                              </div>
                        </div>
                        <div class="modal-footer">
					<input name="enviarcadastro" type="hidden" id="enviarcadastro" value="1">
                              <button type="submit" class="btn btn-success px-5 rounded-0">Enviar</button>
                              <button type="button" class="btn btn-outline-secondary px-4 rounded-0" data-dismiss="modal">Fechar</button>
                        </div>
                  </form>
            </div>
      </div>
</div>