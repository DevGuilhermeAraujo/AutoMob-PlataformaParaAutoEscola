<?php
include_once '../BackEnd/sessao.php';
requiredLogin(getDbUtils()->PERMISSION_ALUNO());  

$db = new Conexao();
$idUser = getId();
if (isset($_POST['data']) && isset($_POST['veiculo'])) {
    $dataEscolhida = $_POST['data'];
    $veiculoEscolhido = $_POST['veiculo'];
    function isDiaUtil($data)
    {
        // Converte a data para um objeto DateTime
        $dataObj = new DateTime($data);
        // Obtém o número do dia da semana (0 para domingo, 1 para segunda, etc.)
        $diaSemana = $dataObj->format('N');
        // Retorna verdadeiro se for um dia útil (segunda a sexta)
        return ($diaSemana >= 1 && $diaSemana <= 5);
    }
    function obterHorariosDisponiveis($dataEscolhida)
    {
        global $db;
        // Verifica se a data escolhida é um dia útil
        if (isDiaUtil($dataEscolhida)) {
            // Lógica para gerar horários disponíveis nos dias úteis
            $horariosDisponiveis = [];
            $horarioInicio = new DateTime('07:00');
            $horarioFim = new DateTime('22:00');
            while ($horarioInicio <= $horarioFim) {
                $horariosDisponiveis[] = $horarioInicio->format('H:i');
                $horarioInicio->add(new DateInterval('PT1H')); // Adiciona 1 hora
            }
        } else {
            // Se não for um dia útil, retorna um array vazio (fechado)
            $horariosDisponiveis = [];
        }
        // Agora, você pode consultar o banco de dados para obter os horários já agendados para a data escolhida
        $horariosAgendados = obterHorariosAgendados($dataEscolhida);
        // Remove os horários já agendados dos disponíveis
        $horariosAgendados = array_map(function ($hora) {
            return (new DateTime($hora))->format('H:i');
        }, $horariosAgendados);
        $horariosDisponiveis = array_diff($horariosDisponiveis, $horariosAgendados);
        return $horariosDisponiveis;
    }
    // Função para obter os horários já agendados para uma data específica do banco de dados
    function obterHorariosAgendados($dataEscolhida)
    {
        global $db;
        // Aqui você faria uma consulta ao banco de dados para obter os horários agendados na data escolhida.
        // Retorna um array com os horários agendados para essa data.
        // Exemplo fictício
        $result = $db->executar("SELECT horario_aula FROM agendamentos WHERE data_aula = '$dataEscolhida'");
        $horariosAgendados = array();
        foreach ($result as $row) {
            $horariosAgendados[] = $row['horario_aula'];
        }
        return $horariosAgendados;
    }
    // Exemplo de uso:
    $horariosDisponiveis = obterHorariosDisponiveis($dataEscolhida);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeUsuario</title>
    <link rel="stylesheet" href="Usuario.css">
    <link rel="stylesheet" href="../index.css">
    <script src="../backEnd/script.js"></script>
</head>
<body>
    <!--
    <div class="Inicio">
        <h1>Olá, seja bem vindo <span><?= getNome() ?> //Aqui deverá aparecer o nome do usuário</span></h1>
    </div>
    -->
    <?= HTML::getInicioPage() ?>
    
    <div class="Nav">
        
        <a href="../backEnd/logout.php"><img class="iconeNav" src="../Imgs/icoSair.png" alt="icone sair"> Sair</a>
       
    </div>
    <div class="Agenda">
        <h2>Meus horários</h2>
        <div class="titulos">
            <p>
                <span>Data</span>
                <span>Carro</span>
                <span>Placa</span>
                <span>Professor</span>
                <span>Desmarcar</span>
            </p>
        </div>
        <?php
        $result = $db->executar("SELECT a.id, DATE_FORMAT(a.data_aula, '%d/%m/%Y') AS data_aula, a.horario_aula, c.marca, c.placa, vi.nome FROM agendamentos AS a JOIN  carros AS c ON a.carro_id = c.id JOIN view_instrutores AS vi ON a.Instrutor_id = vi.id WHERE a.aluno_id = '$idUser'", true);
        if ($result->rowCount() == 0) {
            echo '<p>Não há horários marcados para você </p>';
        } else {
            foreach ($result as $agendamento) {
                $idAgendamento = $agendamento['id'];
                $dataAula = $agendamento['data_aula'];
                $horarioAula = $agendamento['horario_aula'];
                $marcaCarro = $agendamento['marca'];
                $placaCarro = $agendamento['placa'];
                $nomeProfessor = $agendamento['nome'];
                echo '<p>';
                echo "<span>$dataAula $horarioAula</span>";
                echo "<span>$marcaCarro</span>";
                echo "<span>$placaCarro</span>";
                echo "<span>$nomeProfessor</span>";
                //echo "<a href='../backEnd/processRemoverAgendamento.php?idAgendamento=$idAgendamento'><button>X</button></a>";
                echo "<button onclick='let msg1 = new MsgBox(); msg1.showInLine({_idName: \"msg11\", _type: msg1.SET_TYPE_TEXT ,_title: \"Excluir horário?\", _menssagem: \"Tem certeza que deseja excluir este horário?\", _btnOkName: \"Sim\", _btnOkHref: \"../backEnd/processRemoverAgendamento.php?idAgendamento=".$idAgendamento."\", _btnCancelName: \"Cancelar\", _autoDestroy: true});'>X</button>";
                echo "</p>";
            }
        }
        ?>
    </div>
    <form method="POST">
        <h2><img id="Agenda" src="../Imgs/icoAgenda.png" alt="icone agendamento"> Agendar horário</h2>
        <select name="veiculo" required>
            <option value="">Veículo</option>
            <?php
            $result = $db->executar("SELECT id, modelo FROM carros");
            foreach ($result as $carros) {
                $idCarro = $carros['id'];
                $modeloCarro = $carros['modelo'];
                echo "<option value='$idCarro'>$modeloCarro</option>";
            }
            ?>
        </select>
        <input type="date" name="data" required>
        <input type="submit" name="submit" value="Visualizar horários disponíveis">
    </form>
    <?php
    if (isset($dataEscolhida)) {
    ?>
        <div id="horarios">
            <?php
            echo "<h2>$dataEscolhida</h2>";
            if (empty($horariosDisponiveis)) {
                echo "<p>Fechado</p>";
            } else {
                foreach ($horariosDisponiveis as $horario) {
                    echo "<i><a href='../backEnd/processLancarAgendamento.php?horario=$horario&dtEscolhida=$dataEscolhida&veicEscolhido=$veiculoEscolhido'>$horario</a></i>";
                }
            }
            ?>
        </div>
    <?php
    }
    ?>
</body>
</html>