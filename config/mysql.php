<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_startup_errors', true);
ini_set('display_errors', true);
session_start();
require_once "config.php";
require_once RootDir.'vendor/autoload.php';

$con = con();
$email = '';
$login = '';
$msg = '';
$_SESSION["timeout"] = 0;
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
            $msg = "Preencha o campo de forma devida!";
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


function evalAsMath($str)
{

    $error = false;
    $div_mul = false;
    $add_sub = false;
    $result = 0;

    $str = preg_replace('/[^\d\.\+\-\*\/]/i', '', $str);
    $str = rtrim(trim($str, '/*+'), '-');

    if ((strpos($str, '/') !== false || strpos($str, '*') !== false)) {
        $div_mul = true;
        $operators = array('*', '/');
        while (!$error && $operators) {
            $operator = array_pop($operators);
            while ($operator && strpos($str, $operator) !== false) {
                if ($error) {
                    break;
                }
                $regex = '/([\d\.]+)\\' . $operator . '(\-?[\d\.]+)/';
                preg_match($regex, $str, $matches);
                if (isset($matches[1]) && isset($matches[2])) {
                    if ($operator == '+') $result = (float)$matches[1] + (float)$matches[2];
                    if ($operator == '-') $result = (float)$matches[1] - (float)$matches[2];
                    if ($operator == '*') $result = (float)$matches[1] * (float)$matches[2];
                    if ($operator == '/') {
                        if ((float)$matches[2]) {
                            $result = (float)$matches[1] / (float)$matches[2];
                        } else {
                            $error = true;
                        }
                    }
                    $str = preg_replace($regex, $result, $str, 1);
                    $str = str_replace(array('++', '--', '-+', '+-'), array('+', '+', '-', '-'), $str);
                } else {
                    $error = true;
                }
            }
        }
    }

    if (!$error && (strpos($str, '+') !== false || strpos($str, '-') !== false)) {
        $add_sub = true;
        preg_match_all('/([\d\.]+|[\+\-])/', $str, $matches);
        if (isset($matches[0])) {
            $result = 0;
            $operator = '+';
            $tokens = $matches[0];
            $count = count($tokens);
            for ($i = 0; $i < $count; $i++) {
                if ($tokens[$i] == '+' || $tokens[$i] == '-') {
                    $operator = $tokens[$i];
                } else {
                    $result = ($operator == '+') ? ($result + (float)$tokens[$i]) : ($result - (float)$tokens[$i]);
                }
            }
        }
    }

    if (!$error && !$div_mul && !$add_sub) {
        $result = (float)$str;
    }

    return $error ? 0 : $result;
}


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
function TirarPorcento($Valor_Atual, $Valor_Maximo)
{
    if(($Valor_Maximo==0 AND $Valor_Atual == 0) OR $Valor_Maximo == 0){return 0;}
    return minmax((($Valor_Atual/$Valor_Maximo) * 100),0,100);
}

function DadoDinamico($dado, $FOR, $AGI, $INT, $PRE, $VIG): string
{
    $tese = [];
    $FOR = (($FOR<=0 || $FOR > 10)?0:$FOR);//não pode ser maior que 10 e nem menor que 1
    $AGI = (($AGI<=0 || $AGI > 10)?0:$AGI);
    $INT = (($INT<=0 || $INT > 10)?0:$INT);
    $PRE = (($PRE<=0 || $PRE > 10)?0:$PRE);
    $VIG = (($VIG<=0 || $VIG > 10)?0:$VIG);
    $dado = explode("+", $dado);
    foreach ($dado as $s):
        if (str_contains($s, "|")) {
            $s = str_replace("FOR", $FOR, $s);
            $s = str_replace("AGI", $AGI, $s);
            $s = str_replace("INT", $INT, $s);
            $s = str_replace("PRE", $PRE, $s);
            $s = str_replace("VIG", $VIG, $s);
            $s = str_replace("|", '', $s);
            $s = evalAsMath($s);
        }
        $tese[] .= $s;
    endforeach;
    return implode('+', $tese);
}
function calcularvida($nex, $classe, $vigor): int
{
    switch ($classe) {
        default:
            $pv = ((4 + $vigor) * (floor(($nex / 5)) - 1)) + (20 + $vigor);
            break;
        case 2:
            $pv = ((3 + $vigor) * (floor(($nex / 5)) - 1)) + (16 + $vigor);
            break;
        case 3:
            $pv = ((2 + $vigor) * (floor(($nex / 5)) - 1)) + (12 + $vigor);
            break;
    }
    return $pv;
}
function calcularpe($nex, $classe, $presenca): int
{
    switch ($classe) {
        default:
            $pe = (2 + $presenca) + ((2 + $presenca) * minmax((floor(($nex / 5)) - 1)));
            break;
        case 2:
            $pe = (3 + $presenca) + ((3 + $presenca) * minmax((floor(($nex / 5)) - 1)));
            break;
        case 3:
            $pe = (4 + $presenca) + ((4 + $presenca) * minmax((floor(($nex / 5)) - 1)));
            break;
    }
    return $pe;
}function calcularsan($nex, $classe): int
{
    switch ($classe) {
        default:
            $san = 12 + (3 * (floor(($nex / 5)) - 1));
            break;
        case 2:
            $san = 16 + (4 * (floor(($nex / 5)) - 1));
            break;
        case 3:
            $san = 20 + (5 * (floor(($nex / 5)) - 1));
            break;
    }
    return $san;
}
function calcularesq($passiva, $reflexos)
{
    return ($reflexos>=1)?$passiva+$reflexos:0;
}


function minmax($int, $min = 0, $max = 99)
{
    return min(max(intval($int), $min), $max);
}
function test_input($data, $limit = 1000): string
{
    return substr(htmlspecialchars(stripslashes(trim($data))),0,$limit);


}
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
    if ($q->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}
function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function generate_tokens(): array
{
    $selector = bin2hex(random_bytes(16));
    $validator = bin2hex(random_bytes(32));
    return [$selector, $validator, $selector . ':' . $validator];
}
function parse_token(string $token): ?array
{
    $parts = explode(':', $token);

    if ($parts && count($parts) == 2) {
        return [$parts[0], $parts[1]];
    }
    return null;
}
function find_user_token_by_selector(string $selector): bool|array|null
{
    $con = con();
    $ip = getUserIpAddr();
    $a = $con->prepare("SELECT id, selector, hashed_validator, user_id, expiry FROM user_tokens WHERE selector = ? AND expiry >= now() AND `ip` = ? LIMIT 1;");
    $a->bind_param("ss", $selector, $ip);
    $a->execute();
    $ra = $a->get_result();
    return mysqli_fetch_assoc($ra);
}
function delete_user_token(int $user_id): bool
{
    $con = con();
    $q = $con->prepare("DELETE FROM user_tokens WHERE user_id = ?");
    $q->bind_param("i", $user_id);
    return $q->execute();
}
function find_user_by_token(string $token): bool|array|null
{
    $tokens = parse_token($token);

    if (!$tokens) {
        return null;
    }
    $con = con();
    $a = $con->prepare('SELECT usuarios.id, login
            FROM usuarios
            INNER JOIN user_tokens ON user_id = usuarios.id
            WHERE selector = ? AND
                expiry > now()
            LIMIT 1');
    $a->bind_param("s", $tokens[0]);
    $a->execute();
    $ra = $a->get_result();
    return mysqli_fetch_assoc($ra);
}
function insert_user_token(int $user_id, string $selector, string $hashed_validator, string $expiry): bool
{
    $con = con();
    $ip = getUserIpAddr();
    $q = $con->prepare("INSERT INTO `user_tokens` (`id`, `selector`, `hashed_validator`, `user_id`, `expiry`,`ip`) VALUES ('', ? , ? , ? , ? , ? );");
    $q->bind_param("ssiss", $selector, $hashed_validator, $user_id, $expiry, $ip);
    return $q->execute();
}
function remember_me(int $user_id, int $day = 5): void
{
    [$selector, $validator, $token] = generate_tokens();

    // remove all existing token associated with the user id
    delete_user_token($user_id);

    // set expiration date
    $expired_seconds = time() + 60 * 60 * 24 * $day;

    // insert a token to the database
    $hash_validator = password_hash($validator, PASSWORD_DEFAULT);
    $expiry = date('Y-m-d H:i:s', $expired_seconds);
    if (insert_user_token($user_id, $selector, $hash_validator, $expiry)) {
        setcookie('remember_me', $token, $expired_seconds);
    }
}
function logout(): void
{
    if (is_user_logged_in()) {

        // delete the user token
        delete_user_token($_SESSION['UserID']);

        // delete session
        unset($_SESSION['username'], $_SESSION['user_id`']);

        // remove the remember_me cookie
        if (isset($_COOKIE['remember_me'])) {
            unset($_COOKIE['remember_me']);
            setcookie('remember_user', null, -1);
        }

        // remove all session data
        session_unset();
        session_destroy();

        // redirect to the login page
    }
}
function is_user_logged_in(): bool
{
    // check the session
    if (isset($_SESSION['UserLogin'])) {
        return true;
    }

    // check the remember_me in cookie
    $token = filter_input(INPUT_COOKIE, 'remember_me');

    if ($token && token_is_valid($token)) {

        $user = find_user_by_token($token);

        if ($user) {
            return logar($user['login']);
        }
    }
    return false;
}
function token_is_valid($token): bool
{
    $e = explode(':', $token);
    $selector = $e[0];
    $validator = $e[1];

    $tokens = find_user_token_by_selector($selector);
    if (!$tokens) {
        return false;
    }

    return password_verify($validator, $tokens['hashed_validator']);
}

require_once RootDir."conta/check.php";


