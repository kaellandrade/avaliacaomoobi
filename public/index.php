<?php
const LIMITE_MAXIMO_LINKS_PAGINACAO=5;
const LIMITE_POR_PAGINA = 10;
const USUARIO_ADMINISTRADOR = 1;
const USUARIO = 2;
const TAMANHO_MINIMO_NOME = 3;

const STATUS_PERIGO = 'danger';
const STATUS_CUIDADO = 'warning';
const STATUS_INFO = 'info';
const STATUS_SUCESSO = 'success';

const  PUBLICA = 'publica';

use Micaelandrade\Avaliacao\Rotas;

require '../vendor/autoload.php';
$rRotas = new Rotas();