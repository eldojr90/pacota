<?php

require_once 'vendor/autoload.php';

use App\Model\Usuario;

session_start();

$title = "Minha Conta";
ob_start();

$usuario = new Usuario(null,null,null,null,null);
$usuario = unserialize($_SESSION["usLogUpd"]);

?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Meus Dados</h4>
            </div>
            <div class="content">
                <form id="faltUser">
                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nome</label>
                                <input id="name" type="text" class="form-control" 
                                value = "<?php echo $usuario->getNome();?>"
                                readonly>
                            </div>
                        
                            <div class="form-group">
                                <label>Nome de Usuário</label>
                                <input id="username" type="text" class="form-control" 
                                    value = "<?php echo $usuario->getNome_de_usuario();?>"
                                    placeholder="Altere seu nome de usuário" required autofocus selected="selected">
                            </div>
                       
                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" type="email" class="form-control" 
                                    value = "<?php echo $usuario->getEmail();?>"
                                    placeholder="Altere seu email" required>
                            </div>
                        
                            <div class="form-group">
                                <label>Senha Atual</label>
                                <input id="pwd" type="password" class="form-control" 
                                    placeholder="Informe sua senha atual" required>
                            </div>
                        
                            <div class="form-group">
                                <label>Alterar Senha?</label><br/>
                                <input type="radio" value="1" id="optYes" name="optPass"><span id="txtYes">Sim</span><br/>
                                <input type="radio" value="0" id="optNo" name="optPass"><span id="txtNo">Não</span>
                            </div>    
                            

                            <div class="hidden form-group alt-senha">
                                <label>Nova Senha</label>
                                <input id="pass" type="password" class="form-control" 
                                    placeholder="Informe sua nova senha">
                            </div>
                        
                            <div class="hidden form-group alt-senha">
                                <label>Confirmação da Senha</label>
                                <input id="pwdcf" type="password" class="form-control" 
                                    placeholder="Confirme sua nova senha">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" value="Salvar Alterações">
                            </div>

                        </div>
                    
                    </div>

                </form>
            </div>
        </div>
    </div>
</div> 

<script src="./assets/js/comissaoMinhaConta.js"></script>

<?php

$content = ob_get_contents();
ob_end_clean();

require_once 'master.php';