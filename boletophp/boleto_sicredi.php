<?php

$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = 0;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = "2950,00"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["inicio_nosso_numero"] = date("y");	    // Ano da gera��o do t�tulo ex: 07 para 2007
$dadosboleto["nosso_numero"] = "13871";  			        // Nosso numero (m�x. 5 digitos) - Numero sequencial de controle.
$dadosboleto["numero_documento"] = "27.030195.10";	        // Num do pedido ou do documento
$dadosboleto["data_vencimento"] = $data_venc;               // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y");      // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y");  // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	            // Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = "Nome do seu Cliente";
$dadosboleto["endereco1"] = "Endere�o do seu Cliente";
$dadosboleto["endereco2"] = "Cidade - Estado -  CEP: 00000-000";

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "";
$dadosboleto["demonstrativo2"] = "";
$dadosboleto["demonstrativo3"] = "";

// INSTRU��ES PARA O CAIXA
$dadosboleto["instrucoes1"] = "- Não Receber Após o Vencimento";
$dadosboleto["instrucoes2"] = "- Em caso de dúvidas entre em contato conosco: contato@gerboletos.com.br";
$dadosboleto["instrucoes3"] = "";
$dadosboleto["instrucoes4"] = "";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "S";	    // N - remeter cobran�a sem aceite do sacado  (cobran�as n�o-registradas)
                                    // S - remeter cobran�a apos aceite do sacado (cobran�as registradas)
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "A"; // OS - Outros segundo manual para cedentes de cobran�a SICREDI


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - SICREDI
$dadosboleto["agencia"] = "0737"; 	// Num da agencia (4 digitos), sem Digito Verificador
$dadosboleto["conta"] = "39164"; 	// Num da conta (5 digitos), sem Digito Verificador
$dadosboleto["conta_dv"] = "6"; 	// Digito Verificador do Num da conta

// DADOS PERSONALIZADOS - SICREDI
$dadosboleto["posto"]= "17";      // C�digo do posto da cooperativa de cr�dito
$dadosboleto["byte_idt"]= "2";	  // Byte de identifica��o do cedente do bloqueto utilizado para compor o nosso n�mero.
                                  // 1 - Idtf emitente: Cooperativa | 2 a 9 - Idtf emitente: Cedente
$dadosboleto["carteira"] = "A";   // C�digo da Carteira: A (Simples) 

// SEUS DADOS
$dadosboleto["identificacao"] = "Fabio L R de Souza Contabilidade";
$dadosboleto["cpf_cnpj"] = "12.426.126/0001-01";
$dadosboleto["endereco"] = "Rua XYZ, 999, 99.999-999";
$dadosboleto["cidade_uf"] = "Pato Branco - PR";
$dadosboleto["cedente"] = "Fabio L R de Souza Contabilidade";

// N�O ALTERAR!
include("include/funcoes_sicredi.php"); 
include("include/layout_sicredi.php");
?>
