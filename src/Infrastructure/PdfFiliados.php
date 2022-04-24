<?php

namespace Micaelandrade\Avaliacao\Infrastructure;

use Micaelandrade\Avaliacao\Model\Filiado;

/**
 * Classe de pdf para filiados.
 *
 * @author Micael Andrade micaelandrade@moobitech.com.br
 *
 * @version 1.0.0 Versão inicial.
 * @version 1.0.2 Recebendo imagens diferentes pelo construtor.
 */
class PdfFiliados extends \FPDF {
    private string $sTitle;
    private string $sCaminhodaImagem;

    /**
     * Recebe um título e uma imagem para o cabeçalho.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @param string $sTitle
     */
    public function __construct(string $sTitle, string $sCaminhodaImagem) {
        parent::__construct();
        $this->sTitle = $sTitle;
        $this->sCaminhodaImagem = $sCaminhodaImagem;
    }

    /**
     * Monta uma celula.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @since 1.0.0 Versão inicial.
     */
    public function Cell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '') {
        $txt = utf8_decode($txt);
        parent::Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
    }

    /**
     * Cria um PDF com todos filiados aniversariantes.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @since 1.0.0 Versão inicial.
     */
    function tabelaFiliadosAniversariantes($header, $data) {

        $this->SetFillColor(156, 201, 46);
        $this->SetTextColor(255);
        $this->SetDrawColor(19, 23, 51);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');

        $w = array(110, 9, 60);
        for ($i = 0; $i < count($header); $i++) $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();

        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Dados
        $fill = false;
        /** @var Filiado $oFiliado */
        foreach ($data as $oFiliado) {
            $dataNascimento = date_create($oFiliado->getSDataNascimento());

            $sCelular = $oFiliado->getSCelular();
            $celularRex = preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $sCelular);


            $this->Cell($w[0], 6, $oFiliado->getSNome(), 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, date_format($dataNascimento, 'd'), 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, substr($celularRex, 0), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    /**
     * Cria o cabeçalho da tabela.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @since 1.0.0 Versão inicial.
     */
    function Header() {
        if (file_exists('../src/assets/logo.png')) $this->Image($this->sCaminhodaImagem, 10, 0, 40);
        $this->SetFont('Arial', 'B', 25);
        $this->Cell(45);
        $this->Cell(strlen($this->sTitle) * 5, 10, $this->sTitle, 0, 0, 'C');
        $this->Ln(45);
    }

    /**
     * Cria o rodapé da tabela.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @since 1.0.0 Versão inicial.
     */
    function Footer() {
        $oDataAtual = new \DateTimeImmutable('now');
        $oDataFormatada = date_format($oDataAtual, 'd/m/Y H:i');
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->SetX(150);
        $this->Cell(0, 10, "Gerado em $oDataFormatada", 0, 0, 'C');

    }

    /**
     * Cria uma tabela com o total de dependentes por filiados.
     *
     * @author Micael Andrade micaelandrade@moobitech.com.br
     *
     * @since 1.0.0 Versão inicial.
     */
    public function tabelaFiliadosTotalDependentes(array $cabecalho, array $aFiliados) {
        $this->SetFillColor(156, 201, 46);
        $this->SetTextColor(0);
        $this->SetDrawColor(19, 23, 51);
        $this->SetLineWidth(.3);

        // Cabeçalho
        $w = array(70, 50, 60);
        foreach ($cabecalho as $key => $col) $this->Cell($w[$key], 7, $col, 1, 0, 'C', true);
        $this->Ln();
        // Dados
        for ($i = 0; $i < count($aFiliados); $i++) {
            $sCelular = $aFiliados[$i]['flo_celular'];
            $celularRex = preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $sCelular);

            $this->Cell($w[0], 6, $aFiliados[$i]['flo_nome'], 1);
            $this->Cell($w[1], 6, substr($celularRex, 0), 1);
            $this->Cell($w[2], 6, $aFiliados[$i]['contagem'], 1);

            $this->Ln();
        }
    }
}