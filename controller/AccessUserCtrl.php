<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 31/08/17
 * Time: 21:50
 */


namespace Ctrl;

include 'InstalacaoCtrl.php';

use models\AccessUsers;
use ctrl\InstalacaoCtrl;


class AccessUserCtrl
{

    public static $Acess_Cadastro = 100;
    public static $Acess_Cadastro_Grupos = 130;
    public static $Acess_Cadastro_Grupos_Incluir = 131;
    public static $Acess_Cadastro_Grupos_Alterar = 132;
    public static $Acess_Cadastro_Grupos_Excluir = 133;
    public static $Acess_Cadastro_Grupos_Acessos = 134;
    public static $Acess_Cadastro_Grupos_Opcoes = 135;
    
    public static $Acess_Cadastro_Municipios = 140;
    public static $Acess_Cadastro_Municipios_Incluir = 141;
    public static $Acess_Cadastro_Municipios_Alterar = 142;
    public static $Acess_Cadastro_Municipios_Excluir = 143;
    public static $Acess_Cadastro_Municipios_Opcoes = 145;

    public static $Acess_Cadastro_Empresas = 150;
    public static $Acess_Cadastro_Empresas_Incluir = 151;
    public static $Acess_Cadastro_Empresas_Alterar = 152;
    public static $Acess_Cadastro_Empresas_Excluir = 153;
    public static $Acess_Cadastro_Empresas_Config = 154;
    public static $Acess_Cadastro_Empresas_Opcoes = 155;

    public static $Acess_Cadastro_Usuarios = 160;
    public static $Acess_Cadastro_Usuarios_Incluir = 161;
    public static $Acess_Cadastro_Usuarios_Alterar = 162;
    public static $Acess_Cadastro_Usuarios_Excluir = 163;
    public static $Acess_Cadastro_Usuarios_Opcoes = 164;
    public static $Acess_Cadastro_Usuarios_Acessos = 165;
    public static $Acess_Cadastro_Usuarios_AlterarSenha = 166;
    public static $Acess_Cadastro_Usuarios_EliminarSenha = 167;
    public static $Acess_Cadastro_Usuarios_AtivarUsuario = 168;

    public static $Acess_Cadastro_Clientes = 170;
    public static $Acess_Cadastro_Clientes_Incluir = 171;
    public static $Acess_Cadastro_Clientes_Alterar = 172;
    public static $Acess_Cadastro_Clientes_Excluir = 173;
    public static $Acess_Cadastro_Clientes_Opcoes = 175;

    public static $Acess_Cadastro_ProdServ = 180;
    public static $Acess_Cadastro_ProdServ_Incluir = 181;
    public static $Acess_Cadastro_ProdServ_Alterar = 182;
    public static $Acess_Cadastro_ProdServ_Excluir = 183;
    public static $Acess_Cadastro_ProdServ_Opcoes = 185;

    public static $Acess_Rel = 300;
    public static $Acess_Rel_PendFin = 301;
    public static $Acess_Rel_IuguLogs = 302;


    public static $Acess_Lctos = 500;
    public static $Acess_Lctos_Blt = 510;
    public static $Acess_Lctos_Cheq = 511;
    public static $Acess_Lctos_Dupl = 512;
    public static $Acess_Lctos_Fat = 513;
    public static $Acess_Lctos_Antecip = 514;

    public static $Acess_IntegracaoBancaria = 800;
    public static $Acess_IntegracaoBancaria_SIC = 801;

    public static $Acess_Proc = 600;
    public static $Acess_Proc_CancelBlt = 601;
    public static $Acess_Proc_BaixarBlt = 602;

    public static $Acess_ConfGer = 900;
    public static $Acess_ConfGer_Gravar = 901;


    public function getListAcessos()
    {
        $acessos = [];
        //Cadastros
        $acessos[] = new AccessUsers( 'Cadastros', 1, AccessUserCtrl::$Acess_Cadastro, InstalacaoCtrl::$cadastros);
        //Grupos
        $acessos[] = new AccessUsers( 'Grupos', 2,  AccessUserCtrl::$Acess_Cadastro_Grupos, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Incluir', 3, AccessUserCtrl::$Acess_Cadastro_Grupos_Incluir, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Alterar', 3, AccessUserCtrl::$Acess_Cadastro_Grupos_Alterar, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Excluir', 3, AccessUserCtrl::$Acess_Cadastro_Grupos_Excluir, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Acessos', 3, AccessUserCtrl::$Acess_Cadastro_Grupos_Acessos, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Opções', 3, AccessUserCtrl::$Acess_Cadastro_Grupos_Opcoes, InstalacaoCtrl::$cadastros_Gerais);
        //Municipios
        $acessos[] = new AccessUsers( 'Municipios', 2,  AccessUserCtrl::$Acess_Cadastro_Municipios, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Incluir', 3, AccessUserCtrl::$Acess_Cadastro_Municipios_Incluir, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Alterar', 3, AccessUserCtrl::$Acess_Cadastro_Municipios_Alterar, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Excluir', 3, AccessUserCtrl::$Acess_Cadastro_Municipios_Excluir, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Opções', 3, AccessUserCtrl::$Acess_Cadastro_Municipios_Opcoes, InstalacaoCtrl::$cadastros_Gerais);
        //Empresas
        $acessos[] = new AccessUsers( 'Empresas', 2,  AccessUserCtrl::$Acess_Cadastro_Empresas, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Incluir', 3, AccessUserCtrl::$Acess_Cadastro_Empresas_Incluir, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Alterar', 3, AccessUserCtrl::$Acess_Cadastro_Empresas_Alterar, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Excluir', 3, AccessUserCtrl::$Acess_Cadastro_Empresas_Excluir, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Configurações', 3, AccessUserCtrl::$Acess_Cadastro_Empresas_Config, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Opções', 3, AccessUserCtrl::$Acess_Cadastro_Empresas_Opcoes, InstalacaoCtrl::$cadastros_Gerais);
        //Usuários
        $acessos[] = new AccessUsers( 'Usuários', 2,  AccessUserCtrl::$Acess_Cadastro_Usuarios, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Incluir', 3,  AccessUserCtrl::$Acess_Cadastro_Usuarios_Incluir, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Alterar', 3, AccessUserCtrl::$Acess_Cadastro_Usuarios_Alterar, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Excluir', 3, AccessUserCtrl::$Acess_Cadastro_Usuarios_Excluir, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Acessos', 3, AccessUserCtrl::$Acess_Cadastro_Usuarios_Acessos, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Alterar Senha', 3, AccessUserCtrl::$Acess_Cadastro_Usuarios_AlterarSenha, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Eliminar Senha', 3, AccessUserCtrl::$Acess_Cadastro_Usuarios_EliminarSenha, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Ativar Usuário', 3, AccessUserCtrl::$Acess_Cadastro_Usuarios_AtivarUsuario, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Opções', 3, AccessUserCtrl::$Acess_Cadastro_Usuarios_Opcoes, InstalacaoCtrl::$cadastros_Gerais);
        //Clientes
        $acessos[] = new AccessUsers( 'Clientes', 2,  AccessUserCtrl::$Acess_Cadastro_Clientes, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Incluir', 3, AccessUserCtrl::$Acess_Cadastro_Clientes_Incluir, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Alterar', 3, AccessUserCtrl::$Acess_Cadastro_Clientes_Alterar, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Excluir', 3, AccessUserCtrl::$Acess_Cadastro_Clientes_Excluir, InstalacaoCtrl::$cadastros_Gerais);
        $acessos[] = new AccessUsers( 'Opções', 3, AccessUserCtrl::$Acess_Cadastro_Clientes_Opcoes, InstalacaoCtrl::$cadastros_Gerais);
        //ProdServ
        $acessos[] = new AccessUsers( 'Prod. Serv.', 2,  AccessUserCtrl::$Acess_Cadastro_ProdServ, InstalacaoCtrl::$cadastros_ProdServ);
        $acessos[] = new AccessUsers( 'Incluir', 3, AccessUserCtrl::$Acess_Cadastro_ProdServ_Incluir, InstalacaoCtrl::$cadastros_ProdServ);
        $acessos[] = new AccessUsers( 'Alterar', 3, AccessUserCtrl::$Acess_Cadastro_ProdServ_Alterar, InstalacaoCtrl::$cadastros_ProdServ);
        $acessos[] = new AccessUsers( 'Excluir', 3, AccessUserCtrl::$Acess_Cadastro_ProdServ_Excluir, InstalacaoCtrl::$cadastros_ProdServ);
        $acessos[] = new AccessUsers( 'Opções', 3, AccessUserCtrl::$Acess_Cadastro_ProdServ_Opcoes, InstalacaoCtrl::$cadastros_ProdServ);

        // OK - Até Aqui OK...



        //Financeiro
        $acessos[] = new AccessUsers( 'Financeiro', 2, 200, InstalacaoCtrl::$financeiro_Cadastros);
        //FPgto
        $acessos[] = new AccessUsers( 'Formas de Pagamento', 3, 210, InstalacaoCtrl::$financeiro_Cadastros);
        $acessos[] = new AccessUsers( 'Incluir', 4, 211, InstalacaoCtrl::$financeiro_Cadastros);
        $acessos[] = new AccessUsers( 'Alterar', 4, 212, InstalacaoCtrl::$financeiro_Cadastros);
        $acessos[] = new AccessUsers( 'Excluir', 4, 213, InstalacaoCtrl::$financeiro_Cadastros);
        $acessos[] = new AccessUsers( 'Opções', 4, 214, InstalacaoCtrl::$financeiro_Cadastros);
        //LPgto
        $acessos[] = new AccessUsers( 'Local de Pagamento', 3, 220, InstalacaoCtrl::$financeiro_Cadastros);
        $acessos[] = new AccessUsers( 'Incluir', 4, 221, InstalacaoCtrl::$financeiro_Cadastros);
        $acessos[] = new AccessUsers( 'Alterar', 4, 222, InstalacaoCtrl::$financeiro_Cadastros);
        $acessos[] = new AccessUsers( 'Excluir', 4, 223, InstalacaoCtrl::$financeiro_Cadastros);
        $acessos[] = new AccessUsers( 'Opções', 4, 224, InstalacaoCtrl::$financeiro_Cadastros);
        //Portadores
        $acessos[] = new AccessUsers( 'Portadores', 3, 230, InstalacaoCtrl::$financeiro_Cadastros);
        $acessos[] = new AccessUsers( 'Incluir', 4, 231, InstalacaoCtrl::$financeiro_Cadastros);
        $acessos[] = new AccessUsers( 'Alterar', 4, 232, InstalacaoCtrl::$financeiro_Cadastros);
        $acessos[] = new AccessUsers( 'Excluir', 4, 233, InstalacaoCtrl::$financeiro_Cadastros);
        $acessos[] = new AccessUsers( 'Opções', 4, 234, InstalacaoCtrl::$financeiro_Cadastros);

        //Contabilidade
        $acessos[] = new AccessUsers( 'Contabilidade', 2, 400, InstalacaoCtrl::$contabilidade_Cadastros);
        //PlanoGer
        $acessos[] = new AccessUsers( 'Plano Gerencial', 3, 410, InstalacaoCtrl::$contabilidade_Cadastros);
        $acessos[] = new AccessUsers( 'Incluir', 4, 411, InstalacaoCtrl::$contabilidade_Cadastros);
        $acessos[] = new AccessUsers( 'Alterar', 4, 412, InstalacaoCtrl::$contabilidade_Cadastros);
        $acessos[] = new AccessUsers( 'Excluir', 4, 413, InstalacaoCtrl::$contabilidade_Cadastros);
        $acessos[] = new AccessUsers( 'Opções', 4, 414, InstalacaoCtrl::$contabilidade_Cadastros);
        //PlanoCon
        $acessos[] = new AccessUsers( 'Plano Contábil', 3, 420, InstalacaoCtrl::$contabilidade_Cadastros);
        $acessos[] = new AccessUsers( 'Incluir', 4, 421, InstalacaoCtrl::$contabilidade_Cadastros);
        $acessos[] = new AccessUsers( 'Alterar', 4, 422, InstalacaoCtrl::$contabilidade_Cadastros);
        $acessos[] = new AccessUsers( 'Excluir', 4, 423, InstalacaoCtrl::$contabilidade_Cadastros);
        $acessos[] = new AccessUsers( 'Opções', 4, 424, InstalacaoCtrl::$contabilidade_Cadastros);


        //Lançamentos
        $acessos[] = new AccessUsers( 'Mvto. Financeiro', 1, AccessUserCtrl::$Acess_Lctos, InstalacaoCtrl::$lancamentos);
        $acessos[] = new AccessUsers( 'Lcto. Boleto', 2,  AccessUserCtrl::$Acess_Lctos_Blt, InstalacaoCtrl::$lancamentos);
        $acessos[] = new AccessUsers( 'Lcto. Cheque', 2,  AccessUserCtrl::$Acess_Lctos_Cheq, InstalacaoCtrl::$lancamentos);
        $acessos[] = new AccessUsers( 'Lcto. Duplicata', 2,  AccessUserCtrl::$Acess_Lctos_Dupl, InstalacaoCtrl::$lancamentos);
        $acessos[] = new AccessUsers( 'Lcto. Fatura', 2,  AccessUserCtrl::$Acess_Lctos_Fat, InstalacaoCtrl::$lancamentos);
        $acessos[] = new AccessUsers( 'Lcto. Antecipação', 2,  AccessUserCtrl::$Acess_Lctos_Antecip, InstalacaoCtrl::$lancamentos);

        //Relatórios
        $acessos[] = new AccessUsers( 'Relatórios', 1, AccessUserCtrl::$Acess_Rel, InstalacaoCtrl::$relatorios);
        $acessos[] = new AccessUsers( 'Financeiro', 2,  AccessUserCtrl::$Acess_Rel_PendFin, InstalacaoCtrl::$relatorios);
        $acessos[] = new AccessUsers( 'Logs Iugu', 2,  AccessUserCtrl::$Acess_Rel_IuguLogs, InstalacaoCtrl::$relatorios);

        //Procedimentos
        $acessos[] = new AccessUsers( 'Procedimentos', 1, AccessUserCtrl::$Acess_Proc, InstalacaoCtrl::$lancamentos);
        $acessos[] = new AccessUsers( 'Cancelar Boleto', 2, AccessUserCtrl::$Acess_Proc_CancelBlt, InstalacaoCtrl::$lancamentos);
        $acessos[] = new AccessUsers( 'Baixar Boleto', 2, AccessUserCtrl::$Acess_Proc_BaixarBlt, InstalacaoCtrl::$lancamentos);

        //Integração Bancária
        $acessos[] = new AccessUsers( 'Integração Bancária', 1, AccessUserCtrl::$Acess_IntegracaoBancaria, InstalacaoCtrl::$cadastros);
        $acessos[] = new AccessUsers( 'Sicredi', 2, AccessUserCtrl::$Acess_IntegracaoBancaria_SIC, InstalacaoCtrl::$cadastros);

        //ConfGer
        $acessos[] = new AccessUsers( 'Configuração Geral', 1, AccessUserCtrl::$Acess_ConfGer, InstalacaoCtrl::$cadastros);
        $acessos[] = new AccessUsers( 'Gravar', 2, AccessUserCtrl::$Acess_ConfGer, InstalacaoCtrl::$cadastros);

        $result = [];
        foreach ($acessos as $a) {
            if ($a->getLiberacaoInstall()) {
                $result[] = $a;
            }
        }
        return $result;
    }

    public function validatePosicaoInstalled($posicao)
    {
        $list = AccessUserCtrl::getListAcessos();
        foreach ($list as $obj) {
            if ($obj->getPosicao() == $posicao) {
                return $obj->getLiberacaoInstall();
            }
        }
        return false;
    }

}