<?php
    // Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

// $teste = 'AA BB CC';
// CallAPI("GET", "http://127.0.0.1:8000/api/eventos");

// $output = file_get_contents('http://127.0.0.1:8000/api/eventos');
// echo $output;

// echo 'RES: <pre>'; print_r($response); echo '</pre>';

// var_dump(function_exists('curl_version'));
// phpinfo();
return;


//Faz o include da classe Comunicacao
// include 'comunicacao.php';
//Cria um novo objeto da classe
$Comunicacao = new Comunicacao;
//Define os dados de cabeçalho da requisição
// $cabecalho = array(
// 'Content-Type: application/json',
// 'X-AUTH-TOKEN: @@@@@@@@@@@@@@@@@@@'
// );

$cabecalho = array(
    'Content-Type: application/json',
    'X-AUTH-TOKEN: '
);

//Configura o conteúdo a ser enviado
$conteudo = '{"NFe": { "infNFe":{ "versao":"3.10", "ide":{ "cUF":"43", "natOp":"VENDA", "indPag":"0", "mod":"65", "serie":"0", "nNF":"8636", "dhEmi":"2018-03-01T15:29:09-03:00", "tpNF":"1", "idDest":"1", "cMunFG":"4303509", "tpImp":"4", "tpEmis":"1", "tpAmb":"2", "finNFe":"1", "indFinal":"1", "indPres":"1", "procEmi":"0", "verProc":"1.0.0.0" }, "emit":{ "CNPJ":"07364617000135", "xNome":"NF-E EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL", "enderEmit":{ "xLgr":"AV ANTONIO DURO", "nro":"100", "xBairro":"CENTRO", "cMun":"4303509", "xMun":"CAMAQUA", "UF":"RS", "CEP":"96180000", "cPais":"1058", "xPais":"BRASIL" }, "IE":"0170108708", "CRT":"3" }, "det":[ { "nItem":1, "prod":{ "cProd":"2", "cEAN":"7897348203810", "xProd":"NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL", "NCM":"30023010", "CFOP":"5102", "uCom":"UN", "qCom":"1", "vUnCom":"132.00", "vProd":"132.00", "cEANTrib":"7897348203810", "uTrib":"UN", "qTrib":"1", "vUnTrib":"132.00", "indTot":"1" }, "imposto":{ "ICMS":{ "ICMS00":{ "orig":"0", "CST":"00", "modBC":"3", "vBC":"132.00", "pICMS":"18.00", "vICMS":"23.76" } }, "PIS":{ "PISAliq":{ "CST":"01", "vBC":"132.00", "pPIS":"0.00", "vPIS":"0.00" } }, "COFINS":{ "COFINSAliq":{ "CST":"01", "vBC":"132.00", "pCOFINS":"0.00", "vCOFINS":"0.00" } } } } ], "total":{ "ICMSTot":{ "vBC":"132.00", "vICMS":"23.76", "vBCST":"0.00", "vST":"0.00", "vProd":"132.00", "vFrete":"0.00", "vSeg":"0.00", "vDesc":"0.00", "vII":"0.00", "vIPI":"0.00", "vPIS":"0.00", "vCOFINS":"0.00", "vOutro":"0.00", "vNF":"132.00", "vICMSDeson":"0.00" } }, "transp":{ "modFrete":"9" }, "pag":{ "tPag":"01", "vPag":"132.00" }, "infAdic":{ "infCpl":"NOTA FISCAL EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL" } } }}';
// $conteudo = '';

//Define a URL para consumo do serviço
// $url = 'https://nfce.ns.eti.br/v1/nfce/issue';
$url = 'http://127.0.0.1:8000/api/eventos';
//Tipo de requisição: POST
$tpRequisicao = 'GET';

//Faz a chamada da função, passando os parâmetros
$resposta = $Comunicacao->enviaConteudoParaAPI($cabecalho, $conteudo, $url, $tpRequisicao);
//Exibe a resposta da API
echo 'aaaaaaa--a---**: '.$resposta;




class Comunicacao {
    public function enviaConteudoParaAPI($cabecalho = array(), $conteudoAEnviar, $url, $tpRequisicao) {
    try{
        echo 'URL: <pre>'; print_r($url); echo '</pre>';


        //Inicializa cURL para uma URL.
        $ch = curl_init($url);

        echo 'CH: <pre>'; print_r($ch); echo '</pre>';
        
        //Marca que vai enviar por POST(1=SIM), caso tpRequisicao seja igual a "POST"
        if ($tpRequisicao == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            //Passa o conteúdo para o campo de envio por POST
            curl_setopt($ch, CURLOPT_POSTFIELDS, $conteudoAEnviar);
        }
        
        //Se foi passado como parâmetro, adiciona o cabeçalho à requisição
        if (!empty($cabecalho)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecalho);
        }
        
        //Marca que vai receber string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



        /*
        Caso você não receba retorno da API, pode estar com problema de SSL.
        Remova o comentário da linha abaixo para desabilitar a verificação.
        */
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // echo 'aaaa: <pre>'; print_r($ch); echo '</pre>';

        //Inicia a conexão
        $resposta = curl_exec($ch);
        echo 'res: <pre>'; print_r($resposta); echo '</pre>';

        //Fecha a conexão
        curl_close($ch);
        
        // echo"******** até aqui vai **********";
        // return;


    }catch(Exception $e){
        return $e->getMessage();
    }
    
        return $resposta;
    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVENTOS</title>
</head>
<body>
    <!-- LISTA DE EVENTOS DISPONÍVEIS: -->
    
    
</body>
</html>