<?php
include_once "conexao.php";
class Edit
{
    public $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function cliente($id_cliente, $nome_cliente, $email_cliente, $telefone_celular, $telefone_contato, $cep, $cidade, $uf, $bairro, $rua, $complemento)
    {
        try {
            if (isset($cep) && isset($cidade) && isset($uf) && isset($bairro) && isset($nome_cliente)) :
                $sqlcliente = "UPDATE cliente as c JOIN endereco as e ON c.endereco_id_endereco = e.id_endereco SET c.nome_completo= :nome, c.email_cliente = :email_cliente,
        c.telefone_celular=:telefone_celular, c.telefone_contato=:telefone_contato, e.cep = :cep, e.cidade = :cidade, e.uf=:uf, 
        e.bairro= :bairro, e.rua=:rua, e.complemento=:complemento WHERE c.id_cliente =$id_cliente";
                $query = $this->conexao->prepare($sqlcliente);
                $query->bindParam(":nome", $nome_cliente);
                $query->bindParam(":email_cliente", $email_cliente);
                $query->bindParam(":telefone_celular", $telefone_celular);
                $query->bindParam(":telefone_contato", $telefone_contato);
                $query->bindParam(":cep", $cep);
                $query->bindParam(":cidade", $cidade);
                $query->bindParam(":uf", $uf);
                $query->bindParam(":bairro", $bairro);
                $query->bindParam(":rua", $rua);
                $query->bindParam(":complemento", $complemento);
                $query->execute();

                if ($query->rowCount() > 0) :
                    echo "<script>alert('Foi feita a alteração')</script>";
                    echo "<script>window.location.href ='../dashboard.php'</script>";
                endif;
            endif;
        } catch (PDOException $e) {
            echo "Erro $e";
        }
    }

    public function eletronicoReparo($id_reparo, $modelo, $marca, $numero, $descricao, $data_recebimento, $data_previsao, $data_entrega, $observacao, $mao_obra, $custo_peca, $valor_total, $status_id_status, $tecnico_id_tecnico)
    {
        if (isset($modelo) && isset($marca) && isset($data_recebimento) && isset($data_previsao)) :
            $sqleletronicoReparo = "UPDATE `reparo` r JOIN eletronico e on e.id_eletronico = r.eletronico_id_eletronico SET r.data_recebimento=:data_recebimento,r.data_previsao=:data_previsao,r.data_entrega=:data_entrega,r.observacao=:observacao,r.mao_obra=:mao_obra, r.custo_peca=:custo_peca, r.valor_total=:valor_total,e.modelo =:modelo, e.marca =:marca, e.numero = :numero, e.descricao = :descricao, r.tecnico_id_tecnico =:tecnico_id_tecnico, r.status_id_status =:status_id_status WHERE r.id_reparo = $id_reparo;";
            $queryeletronicoReparo = $this->conexao->prepare($sqleletronicoReparo);
            $queryeletronicoReparo->bindParam(":data_recebimento", $data_recebimento);
            $queryeletronicoReparo->bindParam(":data_previsao", $data_previsao);
            $queryeletronicoReparo->bindParam(":data_entrega", $data_entrega);
            $queryeletronicoReparo->bindParam(":observacao", $observacao);
            $queryeletronicoReparo->bindParam(":mao_obra", $mao_obra);
            $queryeletronicoReparo->bindParam(":custo_peca", $custo_peca);
            $queryeletronicoReparo->bindParam(":valor_total", $valor_total);
            $queryeletronicoReparo->bindParam(":modelo", $modelo);
            $queryeletronicoReparo->bindParam(":marca", $marca);
            $queryeletronicoReparo->bindParam(":numero", $numero);
            $queryeletronicoReparo->bindParam(":descricao", $descricao);
            $queryeletronicoReparo->bindParam(":tecnico_id_tecnico", $tecnico_id_tecnico);
            $queryeletronicoReparo->bindParam(":status_id_status", $status_id_status);
            $queryeletronicoReparo->execute();

            if ($queryeletronicoReparo->rowCount() > 0) :
                echo "<script>alert('Foi feita a alteração')</script>";
                echo "<script>window.location.href ='../dashboard.php'</script>";
            endif;
        endif;
    }

    public function dataEntrega($id_reparo, $data_entrega)
    {
        if (isset($modelo) && isset($marca) && isset($data_recebimento) && isset($data_previsao)) :
            $sqleletronicoReparo = "UPDATE `reparo` r SET r.data_entrega=:data_entrega WHERE r.id_reparo = $id_reparo;";
            $queryeletronicoReparo = $this->conexao->prepare($sqleletronicoReparo);
            $queryeletronicoReparo->bindParam(":data_entrega", $data_entrega);
            $queryeletronicoReparo->execute();

            if ($queryeletronicoReparo->rowCount() > 0) :
                echo "<script>alert('Foi feita a alteração')</script>";
                echo "<script>window.location.href ='../dashboard.php'</script>";
            endif;
        endif;
    }

    public function tecnico($id_tecnico, $cep, $cidade, $uf, $bairro, $rua, $complemento, $nome_tecnico, $telefone_tecnico)
    {
        $sqlTecnico = "UPDATE `tecnico` t JOIN endereco e ON t.endereco_id_endereco = e.id_endereco SET t.nome_tecnico=:nome_tecnico,
        t.telefone_tecnico=:telefone_tecnico, e.cep = :cep, e.cidade = :cidade, e.uf=:uf, 
        e.bairro= :bairro, e.rua=:rua, e.complemento=:complemento WHERE t.id_tecnico = $id_tecnico";
        $queryTecnico = $this->conexao->prepare($sqlTecnico);
        $queryTecnico->bindParam(":nome_tecnico", $nome_tecnico);
        $queryTecnico->bindParam(":telefone_tecnico", $telefone_tecnico);
        $queryTecnico->bindParam(":cep", $cep);
        $queryTecnico->bindParam(":cidade", $cidade);
        $queryTecnico->bindParam(":uf", $uf);
        $queryTecnico->bindParam(":bairro", $bairro);
        $queryTecnico->bindParam(":rua", $rua);
        $queryTecnico->bindParam(":complemento", $complemento);
        $queryTecnico->execute();
        if ($queryTecnico->rowCount() > 0) :
            echo "<script>alert('Foi feita a alteração')</script>";
            echo "<script>window.location.href ='../dashboard.php'</script>";
        endif;
    }

    public function login($id_login, $nome_login, $nome_loja, $email_usuario, $senha_usuario)
    {
        try {
            $sqlLogin = "UPDATE `login` l SET nome_login=:nome_login, nome_loja=:nome_loja, email_usuario =:email_usuario, senha_usuario =:senha_usuario WHERE l.id_login = $id_login";
            $queryLogin = $this->conexao->prepare($sqlLogin);
            $queryLogin->bindParam(":nome_login", $nome_login);
            $queryLogin->bindParam(":nome_loja", $nome_loja);
            $queryLogin->bindParam(":email_usuario", $email_usuario);
            $queryLogin->bindParam(":senha_usuario", $senha_usuario);
            $queryLogin->execute();
            if ($queryLogin->rowCount() > 0) :
                echo "<script>alert('Foi feita a alteração')</script>";
                echo "<script>window.location.href ='../dashboard.php'</script>";
            endif;
        } catch (PDOException $e) {
            echo "";
        }
    }
    public function controle($id_controle, $nome_completo, $email_controle, $senha_controle)
    {
        try {
            $sqlControle = "UPDATE `controle` SET nome_completo=:nome_completo, email_controle =:email_controle, senha_controle =:senha_controle WHERE id_controle = $id_controle";
            $queryControle = $this->conexao->prepare($sqlControle);
            $queryControle->bindParam(":nome_completo", $nome_completo);
            $queryControle->bindParam(":email_controle", $email_controle);
            $queryControle->bindParam(":senha_controle", $senha_controle);
            $queryControle->execute();
            if ($queryControle->rowCount() > 0) :
                echo "<script>alert('Foi feita a alteração')</script>";
                echo "<script>window.location.href ='../dashboardControle.php'</script>";
            endif;
        } catch (PDOException $e) {
            echo "<script>window.location.href ='../dashboardControle.php'</script>";
        }
    }
    public function loginSenha($id_login, $senha_usuario)
    {
        try {
            $sqlLogin = "UPDATE `login` l SET senha_usuario =:senha_usuario WHERE l.id_login = $id_login";
            $queryLogin = $this->conexao->prepare($sqlLogin);
            $queryLogin->bindParam(":senha_usuario", $senha_usuario);
            $queryLogin->execute();
            if ($queryLogin->rowCount() > 0) :
                echo "<script>alert('Foi feita a alteração')</script>";
                echo "<script>window.location.href ='../dashboard.php'</script>";
            endif;
        } catch (PDOException $e) {
            echo "<script>window.location.href ='../dashboard.php'</script>";
        }
    }
}

$editar = new Edit($conexao);
