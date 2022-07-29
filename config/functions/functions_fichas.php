<?php

//Calculo bases
function calcularvida($nex, $classe, $vigor, $trilha = 0 , $origem = 0 , $extra = 0, $extra_type = 0): int
{
	// Type 1: Start only;
	// Type 2: Start and nex;
	// Type 3: Nex Only
	switch ($extra_type){
		default:
			$extra_start = $extra;
			$extra_nex = 0;
			break;
		case 2:
			$extra_start = $extra;
			$extra_nex = $extra;
			break;
		case 3:
			$extra_start = 0;
			$extra_nex = $extra;
			break;
	}
	switch ($origem){
		default:
			$extra_start = 0;
			$extra_nex = 0;
			break;
		case 8:
			$extra_start = 0;
			$extra_nex += 1;
			break;
	}


	switch ($classe) {
		default:
			switch ($trilha){
				case 5:
					$extra_nex += 1;
					break;
			}
			$pv = ((4 + $vigor + $extra_start) * (floor(($nex / 5)) - 1)) + (20 + $vigor + $extra_nex);
			break;
		case 2:
			switch ($trilha){
				default:
					break;
			}
			$pv = ((3 + $vigor + $extra_start) * (floor(($nex / 5)) - 1)) + (16 + $vigor + $extra_nex);
			break;
		case 3:
			switch ($trilha){
				default:
					$pv = ((2 + $vigor + $extra_start) * (floor(($nex / 5)) - 1)) + (12 + $vigor + $extra_nex);
					break;
			}
			break;
	}
	return $pv;
}
function calcularpe($nex, $classe, $presenca, $trilha = 0 , $origem = 0 , $extra = 0, $extra_type = 0): int
{
	// Type 1: Start only;
	// Type 2: Start and nex;
	// Type 3: Nex Only
	switch ($extra_type){
		default:
			$extra_start = $extra;
			$extra_nex = 0;
			break;
		case 2:
			$extra_start = $extra;
			$extra_nex = $extra;
			break;
		case 3:
			$extra_start = 0;
			$extra_nex = $extra;
			break;
	}
	switch ($origem){
		default:
			$extra_start = 0;
			$extra_nex = 0;
			break;
	}

	switch ($classe) {
		default:
			switch ($trilha){
				default:
					break;
			}
			$pe = (2 + $presenca + $extra_start) + ((2 + $presenca + $extra_nex) * minmax((floor(($nex / 5)) - 1)));
			break;
		case 2:
			switch ($trilha){
				default:
					break;
			}
			$pe = (3 + $presenca + $extra_start) + ((3 + $presenca + $extra_nex) * minmax((floor(($nex / 5)) - 1)));
			break;
		case 3:
			switch ($trilha){
				default:
					break;
			}
			$pe = (4 + $presenca + $extra_start) + ((4 + $presenca + $extra_nex) * minmax((floor(($nex / 5)) - 1)));
			break;
	}
	return $pe;
}
function calcularsan($nex, $classe, $trilha = 0 , $origem = 0 , $extra = 0, $extra_type = 0): int
{
	// Type 1: Start only;
	// Type 2: Start and nex;
	// Type 3: Nex Only
	switch ($extra_type){
		default:
			$extra_start = $extra;
			$extra_nex = 0;
			break;
		case 2:
			$extra_start = $extra;
			$extra_nex = $extra;
			break;
		case 3:
			$extra_start = 0;
			$extra_nex = $extra;
			break;
	}
	switch ($origem){
		default:
			$extra_start = 0;
			$extra_nex = 0;
			break;
		case 26:
			$extra_start = 0;
			$extra_nex = 1;
			break;

	}

	switch ($classe) {
		default:
			switch ($trilha){
				default:
					break;
			}
			$san = (12 + $extra_start) + ((3 + $extra_nex) * (floor(($nex / 5)) - 1));
			break;
		case 2:
			switch ($trilha){
				default:
					break;
			}
			$san = (16 + $extra_start) + ((4 + $extra_nex) * (floor(($nex / 5)) - 1));
			break;
		case 3:
			switch ($trilha){
				default:
					break;
			}
			$san = (20 + $extra_start) + ((5 + $extra_nex) * (floor(($nex / 5)) - 1));
			break;
	}
	return $san;
}


//Verificações gerais
function VerificarID($id): bool
{
	$id = intval($id);
	if (isset($_SESSION["UserID"])) {
		$userid = $_SESSION["UserID"];
		if ($id > 0) {
			$con = con();
			$q = $con->prepare("Select * FROM `fichas_personagem` WHERE `id` = ? AND `usuario` = ? ;");
			$q->bind_param("ii", $id, $userid);
			$q->execute();
			$rq = $q->get_result();
			$a = $con->prepare("Select * FROM `ligacoes` WHERE `id` = ? AND `id_usuario` = ?");
			$a->bind_param("ii", $id, $userid);
			$a->execute();
			$aq = $a->get_result();
			if ($rq->num_rows > 0 || $aq->num_rows > 0) {
				return true;
			}
		}
	}
	return false;
}
function VerificarMestre($mid): bool
{
	$con = con();
	$q = $con->query("Select * FROM `missoes` WHERE `mestre` = '" . $_SESSION["UserID"] . "' and `id` = '" . intval($mid) . "';");
	$t = $con->prepare("Select * FROM `missoes` WHERE `mestre` = ? and `token` = ? ;");
	$t->bind_param('is', $_SESSION["UserID"], $mid);
	$t->execute();
	if ($q->num_rows OR $t->num_rows) {
		return true;
	} else {
		return false;
	}
}

//Functions Gerais
function ValorParaRolarDado($Atributo): int
{
	if($Atributo >= 1) {
		return $Atributo;
	} else if ($Atributo == 0) {
		return $Atributo-2;
	} else {
		return $Atributo -2;
	}
}
function ClearRolar($dado, $Return_Error = false): bool|array
{
	$success = true;
	if (!empty($dado)) {
		if (preg_match('/^[d0-9+-]+\S$/', $dado)) {
			if ($success) {
				$dado = str_replace("-", "+-", $dado);
				$a = explode('+', $dado);
				foreach ($a as $dados):
					if ($success) {
						if (!empty($dados)) {
							$b = explode('d', $dados);
							$b[0] = intval($b[0]);
							if (($b[0] > 10 || $b[0] < -10) and isset($b[1])) {
								$success = false;
								$msg = "Não pode rolar mais de 10 dados de uma vez.";
							}
							if (($b[0] > 30 || $b[0] < -30) and !isset($b[1])) {
								$success = false;
								$msg = "Não pode somar além de 30 absolutamente.";
							}
							if ($b[1] > 100) {
								$success = false;
								$msg = "Não pode rolar dados com mais de 100 Lados.";
							}
						}
					}
				endforeach;
			}
		} else {
			$success = false;
			$msg = "Preencha o campo de forma devida! ('D' minúsculo, caso isso)";
		}
	} else {
		$success = false;
		$msg = "Preencha o campo!";
	}
	$data["success"] = $success;
	$data["msg"] = $msg;
	if ($Return_Error) {
		return $data;
	} else {
		return $success;
	}
}
function Rolar($dado, $dano = false): array
{
	$result = [];
	$dado = str_replace("-", "+-", $dado);
	$a = explode('+', $dado);

	foreach ($a as $nome => $dados) {
		if (!empty($dados)) {
			$b = explode('d', $dados);
			$b[0] = intval($b[0]);
			if ($b[0] == 0 and isset($b[1])) {
				$b[0] = 1;
			} else
				if ($b[0] < 0 and isset($b[1])) {
					$b[0] = abs($b[0]);
					$negative = true;
				}
			if (!empty($b[1])) {
				$roll = $b[0]; // quantidade de dados que vão ser jogados
				$rice = $b[1]; // quantida de lados dos dados
				if (!$dano) {
					while ($result["d".$nome]["TotalRolls"] != $roll) {
						$result["d" . $nome]["TotalRolls"] += 1;
						$result["d" . $nome]["d" . $rice]["d" . $result["d" . $nome]["TotalRolls"]] = rand(1, $rice);
					}
					$result["d" . $nome]["dado"] = "d" . $rice;
					$result["d" . $nome]["bestroll"] = max($result["d" . $nome]["d" . $rice]);
					$result["d" . $nome]["worstroll"] = min($result["d" . $nome]["d" . $rice]);
					if ($negative) {
						$result["result"] += $result["d" . $nome]["worstroll"];
						$result["print"] .= "+" . $result["d" . $nome]["worstroll"];
						$result["d" . $nome]["result"] += $result["d" . $nome]["worstroll"];
					} else {
						$result["result"] += $result["d" . $nome]["bestroll"];
						$result["print"] .= "+" . $result["d" . $nome]["bestroll"];
						$result["d" . $nome]["result"] += $result["d" . $nome]["bestroll"];
					}
				} else {
					while ($result["d" . $nome]["TotalRolls"] != $roll) {
						$result["d" . $nome]["TotalRolls"] += 1;
						$result["d" . $nome]["d" . $rice]["d" . $result["d" . $nome]["TotalRolls"]] = rand(1, $rice);
						$result["result"] += $result["d" . $nome]["d" . $rice]["d" . $result["d" . $nome]["TotalRolls"]];
						$result["print"] .= "+" . $result["d" . $nome]["d" . $rice]["d" . $result["d" . $nome]["TotalRolls"]];
					}
					$result["d" . $nome]["dado"] = "d" . $rice;
				}
			} else {
				if ($b[0] > 0) {
					$b[0] = '+' . $b[0];
				}
				$result["result"] += $b[0];
				$result["print"] .= $b[0];
				$result["soma"] = $b[0];
			}
		}
	}
	return ($result);
}
function TirarPorcento($Valor_Atual, $Valor_Maximo)
{
	if(($Valor_Maximo==0 AND $Valor_Atual == 0) OR $Valor_Maximo == 0){return 0;}
	return minmax((($Valor_Atual/$Valor_Maximo) * 100),0,100);
}
function DadoDinamico($dado, $FOR, $AGI, $INT, $PRE, $VIG): string
{
	$FOR = minmax($FOR,0,10);
	$AGI = minmax($AGI,0,10);
	$INT = minmax($INT,0,10);
	$PRE = minmax($PRE,0,10);
	$VIG = minmax($VIG,0,10);
	if (str_contains($dado, "/")) {
		$dado = str_replace("FOR", $FOR, $dado);
		$dado = str_replace("AGI", $AGI, $dado);
		$dado = str_replace("INT", $INT, $dado);
		$dado = str_replace("PRE", $PRE, $dado);
		$dado = str_replace("VIG", $VIG, $dado);
		$dado = str_replace("/", '', $dado);

	}
	return $dado;
}