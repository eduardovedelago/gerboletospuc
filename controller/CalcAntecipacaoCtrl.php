<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 21/02/2019
 * Time: 23:14
 */


class CalcAntecipacaoCtrl
{

    private $dadosCalculo = [];

    /**
     * CalcAntecipacaoCtrl constructor.
     */
    public function __construct()
    {
        $this->clear();
    }


    function clear()
    {
        $dadosCalculo["valor"] = 0.00;
        $dadosCalculo["data_vencimento"] = new DateTime('now');
        $dadosCalculo["data_antecipacao"] = new DateTime('now');
        $dadosCalculo["numeroDias"] = 0;
        $dadosCalculo["perc_fator_diario"] = 0.00;
        $dadosCalculo["fator_calculado"] = 0.00;
        $dadosCalculo["ad_valoren"] = 0;
        $dadosCalculo["iof_calc"] = 0.00;
        $dadosCalculo["iof_diaria_calc"] = 0.00;
        $dadosCalculo["boleto"] = 0.00;
        $dadosCalculo["custo_total"] = 0.00;
        return $dadosCalculo;
    }


    function executeCalculo($valor, $dataVcto, $dataAntecipacao, $fatorCompra, $percAdValoren, $percIOF, $iofDiaria, $custoBoleto)
    {
        $perc_fator_diario = 0.00;
        $fator_calculado = 0.00;
        $ad_valoren = 0.00;
        $iof_calc = 0.00;
        $iof_diaria_calc = 0.00;

        $this->clear();
        $this->dadosCalculo["valor"] = $valor;
        $this->dadosCalculo["data_vencimento"] = $dataVcto;
        $this->dadosCalculo["data_antecipacao"] = $dataAntecipacao;
        $this->dadosCalculo["boleto"] = $custoBoleto;
        $numeroDias = $this->calculaDiferencaDatas($dataVcto, $dataAntecipacao);
        if ($numeroDias > 0 && $fatorCompra > 0) {
            print_r($this->dadosCalculo["diferenca_dias"]);
            $perc_fator_diario = $fatorCompra / 30;
            $fator_calculado = $valor * $numeroDias * ($perc_fator_diario / 100);
            $ad_valoren = $valor * ($percAdValoren / 100);
            //Calculo IOF - Montagem da base + Calculo do percentual
            $baseCalcIOF = $valor - $fator_calculado - $ad_valoren - $custoBoleto;
            $iof_calc = $baseCalcIOF * ($percIOF / 100);
            $iof_diaria_calc = $baseCalcIOF * $numeroDias * ($iofDiaria / 100);
        }
        $custo_total = $fator_calculado + $ad_valoren + $iof_diaria_calc + $iof_calc + $custoBoleto;
        if ($custo_total > 0) {
            $custo_total = round($custo_total, 2);
        }
        if ($custo_total > $valor) {
            $custo_total = $valor;
        }
        $this->dadosCalculo["numeroDias"] = $numeroDias;
        $this->dadosCalculo["perc_fator_diario"] = $perc_fator_diario;
        $this->dadosCalculo["fator_calculado"] = $fator_calculado;
        $this->dadosCalculo["ad_valoren"] = $ad_valoren;
        $this->dadosCalculo["iof_calc"] = $iof_calc;
        $this->dadosCalculo["iof_diaria_calc"] = $iof_diaria_calc;
        $this->dadosCalculo["custo_total"] = $custo_total;
        $this->dadosCalculo["liquido"] = round($valor - $custo_total, 2);
        return $this->dadosCalculo;
    }

    function calculaDiferencaDatas($dataVcto, $dataAntecipacao)
    {
        return $dataVcto->diff($dataAntecipacao)->days;
    }
}