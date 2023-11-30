<?php
include_once "../backEnd/conexao.php";
$db = new Conexao;

if (isset($_GET['data']) && isset($_GET['veiculo'])) {
    $dataEscolhida = $_GET['data'];
    $veiculoSelecionado = $_GET['veiculo'];

    // Inicializa $horariosDisponiveis como um array vazio
    $horariosDisponiveis = [];

    // Implemente a lógica para obter os horários disponíveis
    $horariosDisponiveis = obterHorariosDisponiveis($dataEscolhida, $veiculoSelecionado);

    // Exiba os horários disponíveis
    foreach ($horariosDisponiveis as $horario) {
        echo "<i>$horario</i>";
    }
}

// Função para obter os horários disponíveis
function obterHorariosDisponiveis($dataEscolhida, $veiculoSelecionado)
{
    global $db;
    
    // Aqui você pode implementar a lógica para gerar os horários disponíveis
    $horariosDisponiveis = [];
    $horarioInicio = new DateTime('07:00');
    $horarioFim = new DateTime('22:00');
    while ($horarioInicio <= $horarioFim) {
        $horariosDisponiveis[] = $horarioInicio->format('H:i');
        $horarioInicio->add(new DateInterval('PT1H')); // Adiciona 1 hora
    }

    // Consulta ao banco de dados para obter os horários já agendados na data escolhida
    $result = $db->executar("SELECT horario_aula FROM agendamentos WHERE data_aula = '$dataEscolhida' AND veiculo = '$veiculoSelecionado'");
    $horariosAgendados = array();
    foreach ($result as $row) {
        $horariosAgendados[] = $row['horario_aula'];
    }

    // Remove os horários já agendados dos disponíveis
    $horariosAgendados = array_map(function ($hora) {
        return (new DateTime($hora))->format('H:i');
    }, $horariosAgendados);
    $horariosDisponiveis = array_diff($horariosDisponiveis, $horariosAgendados);

    return $horariosDisponiveis;
}
?>
