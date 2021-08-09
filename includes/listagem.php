<?php

    $mensagem = '';
    if(isset($_GET['status'])){
        switch ($_GET['status']){
            case 'success':
                $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
                break;
            
            case 'error':
                $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
                break;
        }
    }

    $resultados = '';
    foreach($ordens as $ordem){
        $resultados .= '<tr>
                        <td>'.$ordem->id.'</td>
                        <td>'.$ordem->titulo.'</td>
                        <td>'.$ordem->descricao.'</td>
                        <td>'.($ordem->ativo == 's' ? 'Ativo' : 'Inativo').'</td>
                        <td>'.date('d/m/Y à\s H:i:s', strtotime($ordem->data)).'</td>
                        <td>
                            <a href="editar.php?id='.$ordem->id.'">
                                <button type="button" class="btn btn-primary">Editar</button>
                            </a>
                            <a href="excluir.php?id='.$ordem->id.'">
                                <button type="button" class="btn btn-danger">Excluir</button>
                            </a>
                        </td>
                        </tr>';

    }

    $resultados = strlen($resultados) ? $resultados :   '<tr>
                                                            <td colspan="6" class="text-center">
                                                                Nenhuma ordem de serviço encontrada
                                                            </td>
                                                        </tr>';
?>
<main>

    <?=$mensagem?>

    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success">Nova Ordem</button>
        </a>
    </section>

    <section>

        <table class="table bg-light mt-3">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?=$resultados?>
            </tbody>


        </table>

    </section>
</main>