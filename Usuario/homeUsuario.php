<?php
include_once "../backEnd/conexao.php";
$db = new Conexao;

if (isset($_POST['data'])) {

    $dataEscolhida = $_POST['data'];
    function obterHorariosDisponiveis($dataEscolhida)
    {
        // Aqui você pode implementar lógica para gerar os horários disponíveis, por exemplo, de 8h às 18h, em intervalos de 1 hora.
        // Esta é apenas uma implementação de exemplo, você deve ajustar conforme necessário.
        $horariosDisponiveis = [];
        $horarioInicio = new DateTime('07:00');
        $horarioFim = new DateTime('22:00');
        while ($horarioInicio <= $horarioFim) {
            $horariosDisponiveis[] = $horarioInicio->format('H:i');
            $horarioInicio->add(new DateInterval('PT1H')); // Adiciona 1 hora
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
    // Exibir os horários disponíveis
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
</head>

<body>
    <div class="Inicio">
        <h1>Olá, seja bem vindo <span>Fulanim... <!--Aqui deverá aparecer o nome do usuário--></span></h1>
    </div>
    <div class="Nav">
        <a href="../Login/pagLogin.php"><img class="iconeNav" src="../Imgs/icoSair.png" alt="icone sair"> Voltar</a>
        <a href="veiculoUsuario.php"><img class="iconeNav" src="../Imgs/icoVolante.png" alt="icone veículos"> Veículos</a>
        <a href="alunosUUsuario.php"><img class="iconeNav" src="../Imgs/icoUsuario.png" alt="icone usuários"> Alunos</a>
    </div>
    <div class="visual">
            <form>
                <h2><img id="Agenda" src="../Imgs/icoAgenda.png" alt="icone agendamento"> Agendar horário</h2>
                <select name="" id="">
                    <option value="null">Veículo</option>
                    <option value="">Gol</option>
                    <option value="">Fusca</option>
                    <option value="">Honda</option>
                    <option value="">Cavalo</option>
                </select>
                <select name="" id="">
                    <option value="null">Dia</option>
                    <option value="">Segunda</option>
                    <option value="">Terça</option>
                    <option value="">Quarta</option>
                    <option value="">Quinta</option>
                    <option value="">Sexta</option>
                </select>
                <input type="submit" value="Visualizar horários disponíveis">
            </form>
            <div id="horarios">
                <h2>Segunda 01/01/0000</h2>
                <i>07:00</i>
                <i>08:00</i>
                <i>09:00</i>
                <i>10:00</i>
                <i>11:00</i>
                <i>12:00</i>
                <i>13:00</i>
                <i>14:00</i>
                <i>15:00</i>
                <i>16:00</i>
                <i>17:00</i>
                <i>18:00</i>
                <i>19:00</i>
                <i>20:00</i>
                <i>21:00</i>
                <i>22:00</i>
            </div>
    </div>
</body>

</html>