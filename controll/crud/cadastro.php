<?php
include "conexao.php";
class Creat
{
    public $conexao;
    public $id_login;

    public function __construct($conexao, $id_login)
    {
        $this->conexao = $conexao;
        $this->id_login = $id_login;
    }

    // Cadastro cliente funcionando
    public function cliente($cep, $cidade, $uf, $bairro, $rua, $complemento, $nome_completo, $email_cliente, $telefone_celular, $telefone_contato)
    {
        try {
            if (isset($cep) && isset($cidade) && isset($uf) && isset($bairro) && isset($nome_completo)) :
                $sqlendereco = "INSERT INTO `endereco`(`cep`, `cidade`, `uf`, `bairro`, `rua`, `complemento`) VALUES (:cep, :cidade, :uf, :bairro, :rua, :complemento);";
                $query = $this->conexao->prepare($sqlendereco);
                $query->bindParam(':cep', $cep);
                $query->bindParam(':cidade', $cidade);
                $query->bindParam(':uf', $uf);
                $query->bindParam(':bairro', $bairro);
                $query->bindParam(':rua', $rua);
                $query->bindParam(':complemento', $complemento);
                $query->execute();
                $id_endereco = $this->conexao->lastInsertId();

                $sqlCLiente = "INSERT INTO `cliente`(`nome_completo`, `email_cliente`, `telefone_celular`, `telefone_contato`, `endereco_id_endereco`, `login_id_login`) 
        VALUES (:nome_completo, :email_cliente, :telefone_celular, :telefone_contato, :endereco_id_endereco, :login_id_login)";
                $queryCliente = $this->conexao->prepare($sqlCLiente);
                $queryCliente->bindParam(':nome_completo', $nome_completo);
                $queryCliente->bindParam(':email_cliente', $email_cliente);
                $queryCliente->bindParam(':telefone_celular', $telefone_celular);
                $queryCliente->bindParam(':telefone_contato', $telefone_contato);
                $queryCliente->bindParam(':endereco_id_endereco', $id_endereco);
                $queryCliente->bindParam(':login_id_login', $this->id_login);
                $queryCliente->execute();

                $usuario = $this->conexao->lastInsertId();
                if ($queryCliente->rowCount() > 0) :
                    echo "<script>alert('Cadastro feito com Sucesso!');</script>";
                    echo "<script>location.href ='eletronicoReparo.php?id=$usuario' </script>";
                else :
                    echo "<script>window.location.href ='../dashboard.php'</script>";
                endif;
            else :
                echo "<script>alert('Houve erro! Nome não mencionado.');</script>";
                echo "<script>location.href ='../dashboard.php' </script>";
            endif;
        } catch (PDOException $e) {
            echo "<script>location.href ='../dashboard.php' </script>";
        }
    }

    // Cadastro eletronico em teste
    public function eletronico($modelo, $marca, $numero, $descricao, $cliente_id_cliente)
    {
        try {
            $sql = "INSERT INTO `eletronico`(`modelo`, `marca`, `numero`, `descricao`) VALUES (:modelo, :marca, :numero, :descricao)";
            $query = $this->conexao->prepare($sql);
            $query->bindParam(":modelo", $modelo);
            $query->bindParam(":marca", $marca);
            $query->bindParam(":numero", $numero);
            $query->bindParam(":descricao", $descricao);
            $query->execute();

            $eletronico_id_eletronico = $this->conexao->lastInsertId();
            $sqlClienteEletronico = "INSERT INTO `cliente_eletronico`(cliente_id_cliente, eletronico_id_eletronico) VALUES (:cliente_id_cliente, :eletronico_id_eletronico)";
            $queryClienteEletronico = $this->conexao->prepare($sqlClienteEletronico);
            $queryClienteEletronico->bindParam(":cliente_id_cliente", $cliente_id_cliente);
            $queryClienteEletronico->bindParam(":eletronico_id_eletronico", $eletronico_id_eletronico);
            $queryClienteEletronico->execute();

            if ($queryClienteEletronico->rowCount() > 0 && $query->rowCount() > 0) :
                echo "<script>alert('Cadastro feito com Sucesso!');</script>";
            // echo "<script>location.href ='reparo.php?id=$eletronico_id_eletronico' </script>";
            else :
                echo "<script>alert('Cadastro não realizado!');</script>";
                echo "<script>window.location.href ='../dashboard.php'</script>";
            endif;
        } catch (PDOException $e) {
            echo "<script>window.location.href ='../dashboard.php'</script>";
        }
    }

    // Cadastro reparo em teste
    public function reparo($data_recebimento, $data_previsao, $data_entrega, $observacao, $mao_obra, $custo_peca, $valor_total, $status_id_status, $tecnico_id_tecnico, $eletronico_id_eletronico)
    {
        try {
            if (isset($eletronico_id_eletronico)) :
                $sql = "INSERT INTO `reparo`(`data_recebimento`, `data_previsao`, `data_entrega`, `observacao`, `mao_obra`, `custo_peca`,
        `valor_total`, `status_id_status`, `tecnico_id_tecnico`, `eletronico_id_eletronico`)  
       VALUES (:data_recebimento, :data_previsao, :data_entrega, :observacao, :mao_obra, :custo_peca, :valor_total, :status_id_status, :tecnico_id_tecnico, :eletronico_id_eletronico);";
                $query = $this->conexao->prepare($sql);
                $query->bindParam(":data_recebimento", $data_recebimento);
                $query->bindParam(":data_previsao", $data_previsao);
                $query->bindParam(":data_entrega", $data_entrega);
                $query->bindParam(":observacao", $observacao);
                $query->bindParam(":mao_obra", $mao_obra);
                $query->bindParam(":custo_peca", $custo_peca);
                $query->bindParam(":valor_total", $valor_total);
                $query->bindParam(":status_id_status", $status_id_status);
                $query->bindParam(":tecnico_id_tecnico", $tecnico_id_tecnico);
                $query->bindParam(":eletronico_id_eletronico", $eletronico_id_eletronico);
                $query->execute();
                if ($query->rowCount() > 0) :
                    echo "<script>alert('Cadastro feito com Sucesso!');</script>";
                else :
                    echo "<script>alert('Não possivel Cadastrar, Verifique as informaçõe!');</script>";
                    echo "<script>window.location.href ='../dashboard.php'</script>";
                endif;
            else :
                echo "<script>alert('Aparelho não selecionado!');</script>";
                echo "<script>window.location.href ='../dashboard.php'</script>";
            endif;
        } catch (PDOException $e) {
            echo "<script>window.location.href ='../dashboard.php'</script>";
        }
    }


    // Cadastro adicionar (eletronico, cliente_eletronico, reparo) funcionando
    public function adicionar($modelo, $marca, $numero, $descricao, $cliente_id_cliente, $data_recebimento, $data_previsao, $observacao, $mao_obra, $custo_peca, $valor_total, $status_id_status, $tecnico_id_tecnico)
    {

        try {
            if (isset($modelo) && isset($marca) && isset($data_recebimento) && isset($data_previsao)) :
                $sqlEletronico = "INSERT INTO `eletronico`(`modelo`, `marca`, `numero`, `descricao`) VALUES (:modelo, :marca, :numero, :descricao)";
                $queryEletronico = $this->conexao->prepare($sqlEletronico);
                $queryEletronico->bindParam(":modelo", $modelo);
                $queryEletronico->bindParam(":marca", $marca);
                $queryEletronico->bindParam(":numero", $numero);
                $queryEletronico->bindParam(":descricao", $descricao);
                $queryEletronico->execute();

                $eletronico_id_eletronico = $this->conexao->lastInsertId();
                $sqlClienteEletronico = "INSERT INTO `cliente_eletronico`(cliente_id_cliente, eletronico_id_eletronico) VALUES (:cliente_id_cliente, :eletronico_id_eletronico)";
                $queryClienteEletronico = $this->conexao->prepare($sqlClienteEletronico);
                $queryClienteEletronico->bindParam(":cliente_id_cliente", $cliente_id_cliente);
                $queryClienteEletronico->bindParam(":eletronico_id_eletronico", $eletronico_id_eletronico);
                $queryClienteEletronico->execute();


                $sqlReparo = "INSERT INTO `reparo`(`data_recebimento`, `data_previsao`, `observacao`, `mao_obra`, `custo_peca`,
            `valor_total`, `status_id_status`, `tecnico_id_tecnico`, `eletronico_id_eletronico`)  
           VALUES (:data_recebimento, :data_previsao, :observacao, :mao_obra, :custo_peca, :valor_total, :status_id_status, :tecnico_id_tecnico, :eletronico_id_eletronico);";
                $queryReparo = $this->conexao->prepare($sqlReparo);
                $queryReparo->bindParam(":data_recebimento", $data_recebimento);
                $queryReparo->bindParam(":data_previsao", $data_previsao);
                $queryReparo->bindParam(":observacao", $observacao);
                $queryReparo->bindParam(":mao_obra", $mao_obra);
                $queryReparo->bindParam(":custo_peca", $custo_peca);
                $queryReparo->bindParam(":valor_total", $valor_total);
                $queryReparo->bindParam(":status_id_status", $status_id_status);
                $queryReparo->bindParam(":tecnico_id_tecnico", $tecnico_id_tecnico);
                $queryReparo->bindParam(":eletronico_id_eletronico", $eletronico_id_eletronico);
                $queryReparo->execute();

                if ($queryEletronico->rowCount() > 0 && $queryReparo->rowCount() > 0) :
                    echo "<script>alert('Cadastro feito com Sucesso!');</script>";
                    echo "<script>window.location.href ='../dashboard.php'</script>";

                else :
                    // $_SESSION['erro'] = 'Não possivel Cadastrar, Verifique as informaçõe!';
                    echo "<script>alert('Houve erro!');</script>";
                    echo "<script>window.location.href ='../dashboard.php'</script>";
                endif;
            else :
                echo "<script>alert('Campos não preenchidos');</script>";
                echo "<script>window.location.href ='../dashboard.php'</script>";
            endif;
        } catch (PDOException $e) {
            echo "<script>window.location.href ='../dashboard.php'</script>";
        }
    }

    // Cadastro tecnico funcionado
    public function tecnico($cep, $cidade, $uf, $bairro, $rua, $complemento, $nome_tecnico, $telefone_tecnico)
    {
        try {
            if (isset($nome_tecnico)) :
                $sqlendereco = "INSERT INTO `endereco`(`cep`, `cidade`, `uf`, `bairro`, `rua`, `complemento`)
        VALUES (:cep, :cidade, :uf, :bairro, :rua, :complemento);";
                $queryEndereco = $this->conexao->prepare($sqlendereco);
                $queryEndereco->bindParam(':cep', $cep);
                $queryEndereco->bindParam(':cidade', $cidade);
                $queryEndereco->bindParam(':uf', $uf);
                $queryEndereco->bindParam(':bairro', $bairro);
                $queryEndereco->bindParam(':rua', $rua);
                $queryEndereco->bindParam(':complemento', $complemento);
                $queryEndereco->execute();
                $endereco_id_endereco = $this->conexao->lastInsertId();

                $sqlTecnico = "INSERT INTO `tecnico`( `nome_tecnico`, `telefone_tecnico`, `endereco_id_endereco`, `login_id_login`) 
        VALUES (:nome_tecnico,:telefone_tecnico ,:endereco_id_endereco, :login_id_login)";
                $queryTecnico = $this->conexao->prepare($sqlTecnico);
                $queryTecnico->bindParam(':nome_tecnico', $nome_tecnico);
                $queryTecnico->bindParam(':telefone_tecnico', $telefone_tecnico);
                $queryTecnico->bindParam(':endereco_id_endereco', $endereco_id_endereco);
                $queryTecnico->bindParam(':login_id_login', $this->id_login);
                $queryTecnico->execute();
                if ($queryEndereco->rowCount() > 0 && $queryTecnico->rowCount() > 0) :
                    echo "<script>alert('Cadastro feito com Sucesso!');</script>";
                    echo "<script>window.location.href ='../dashboard.php'</script>";
                else :
                    // $_SESSION['erro'] = 'Não possivel Cadastrar, Verifique as informaçõe!';
                    echo "<script>alert('Não possivel Cadastrar, Verifique as informaçõe!');</script>";
                    echo "<script>window.location.href ='../dashboard.php'</script>";
                endif;
            else :
                echo "<script>alert('Não possivel Cadastrar, pois não foi mencionado o nome do tecnico');</script>";
                echo "<script>window.location.href ='../dashboard.php'</script>";
            endif;
        } catch (PDOException $e) {
            echo "<script>window.location.href ='../dashboard.php'</script>";
        }
    }

    // Cadastro status em teste
    public function status($momento)
    {
        try {
            if (isset($momento)) :
                $sqlStatus = "INSERT INTO `statu`(`nome_status`) VALUES (:momento)";
                $queryStatus = $this->conexao->prepare($sqlStatus);
                $queryStatus->bindParam(":momento", $momento);
                $queryStatus->execute();
                if ($queryStatus->rowCount() > 0) :
                    echo "<script>alert('Cadastro feito com Sucesso!');</script>";
                    echo "<script>window.location.href ='../dashboard.php'</script>";
                else :
                    // $_SESSION['erro'] = 'Não possivel Cadastrar, Verifique as informaçõe!';
                    echo "<script>alert('Não possivel Cadastrar, Verifique as informaçõe!');</script>";
                    echo "<script>window.location.href ='../dashboard.php'</script>";
                endif;
            else :
                echo "<script>alert('Não possivel Cadastrar, Verifique as informaçõe!');</script>";
                echo "<script>window.location.href ='../dashboard.php'</script>";
            endif;
        } catch (PDOException $e) {
            echo "<script>window.location.href ='../dashboard.php'</script>";
        }
    }
}

$idLogin = $_SESSION['id_login'];
$creats = new Creat($conexao, $idLogin);
