<?php 

namespace Classes;

use GeradorNome\PalavraQuery;
use GeradorNome\NomeSugerido;

/**
 * GeradorNomes
 */
class Gerador
{
    /**
     * GeradorNomes
     */
    public function __construct()
    {
    }

    function gerarNomes()
    {
        $qtde = 0;

        $palavras = PalavraQuery::create()->find();
        $silabas  = [];
        $timestampAtual = time();

        foreach ($palavras as $palavra) {

            if(empty($palavra->getPalavra())) {
                continue;
            }
            
            $silabasPalavra = explode('-', $palavra->getPalavra());

            foreach ($silabasPalavra as $silaba) {
                
                if(!in_array($silaba, $silabas)) {

                    $silabas[] = $silaba;
                }
            }
        }

        $silabas2  = $silabas;
        $silabas3  = $silabas;
        $qtdeSilabas = count($silabas);
        $nomes = [
            'duas_silabas'=>[],
            'tres_silabas'=>[]
        ];
        
        for ($k = 0; $k < $qtdeSilabas; $k++) {

            $silaba1 = $silabas[$k];
            
            $palavra1[0] = $silaba1;
            $palavra2[0] = $silaba1;

            reset($silabas);
            foreach ($silabas as $silaba2) {

                if($silaba2 == $silaba1) {
                    continue;
                }
                
                $palavra1[1] = $silaba2;
                $palavra2[1] = $silaba2;
                
                $palavra1Formada = implode('', $palavra1);

                if(!in_array($palavra1Formada, $nomes['duas_silabas'])) {
                    $nomes['duas_silabas'][] = $palavra1Formada;
                }

                reset($silabas);
                foreach ($silabas as $silaba3) {

                    if( ($silaba3 == $silaba2) || ($silaba3 == $silaba1) ) {
                        continue;
                    }

                    $palavra2[2] = $silaba3;
                    $palavra2Formada = implode('', $palavra2);
                    
                    if(!in_array($palavra2Formada, $nomes['tres_silabas'])) {
                        if(!in_array($palavra2Formada, $nomes['duas_silabas'])) {
                            $nomes['tres_silabas'][] = $palavra2Formada;
                        }
                    }
                }
            }
        }

        foreach ($nomes as $qtdeSil => $nomesGerados) {

            $qtdSilabas = 2;
            if ($qtdeSil == 'tres_silabas') {
                $qtdSilabas = 3;
            }
            
            foreach ($nomesGerados as $nomeGerado) {
                
                $nm = new NomeSugerido();
                $nm->setNome($nomeGerado);
                $nm->setData($timestampAtual);
                $nm->setQuantidadeSilabas($qtdSilabas);
                $nm->setInicial(substr($nomeGerado, 0, 1));

                try {

                    $nm->save();
                    
                } catch (Exception $e) {
                    echo $e->getMessage();
                }

                $qtde++;
            }
            
        }

        return $qtde;
    }
}
