<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Classe para resolução do desafio.
 */
class Resolucao implements TextWrapInterface {

  /**
   * Atributo que recebe o texto a ser trabalhado.
   *
   * @var string
   */
  private $myText;
  /**
   * Atributo que recebe o vetor de caracteres.
   *
   * @var array
   */
  private $uSafe;
  /**
   * Atributo que recebe a posição atual do vetor.
   *
   * @var int
   */
  private $index;
  /**
   * Tamanho total do texto a ser trabalhado.
   *
   * @var int
   */
  private $len;
  /**
   * Contadora para verificar se ultrapassamos o tamanho da linha.
   *
   * @var int
   */
  private $counter;
  /**
   * Atributo que recebe espaço em branco.
   *
   * @var string
   */
  private $blank;

  /**
   * {@inheritdoc}
   */

  /**
   * Construtor sem parâmetros que inicializa o objeto com valores default.
   */
  public function __construct() {
    $this->myText = "";
    $this->uSafe = [];
    $this->index = 0;
    $this->len = 0;
    $this->counter = 0;
    $this->blank = "";
  }

  /**
   * Método que verifica se um caractere é branco usando Regex.
   *
   * @param string $char
   *   String de um caractere para ser verificada.
   *
   * @return bool
   *   Flag verdadeira se for branco ou falso se não for,
   *   ou se a String for maior do que um caractere.
   *   caractere.
   */
  private function isBlank(string $char): bool  {
    $pattern = "/\s/u";
    if (strlen($char) > 1) {
      echo ("Not Char");
      return FALSE;
    } 
    else {
      if (preg_match($pattern, $char) == 1) {
        return TRUE;
      } 
      else {
        return FALSE;
      }
    }
  }

  /**
   * Método que pega uma palavra do vetor de caracteres e retorna.
   *
   * Atualiza o índice e uma contadora.
   */
  private function getWord(): string {
    $word = "";
    for (; $this->index < $this->len; $this->index++, $this->counter++) {
      if ($this->isBlank($this->uSafe[$this->index])) {
        $this->blank = $this->uSafe[$this->index];
        $this->counter++;
        $this->index++;
        return $word;
      } 
      else {
        $word .= $this->uSafe[$this->index];
      }
    }
    return $word;
  }

  /**
   * Método que pega uma palavra maior que um tamanho e quebra em duas palavras.
   *
   * @param string $word
   *   Palavra que será quebrada.
   * @param string $word2
   *   Referência para retornar segunda palavra.
   * @param int $length
   *   Tamanho máximo que um pedaço pode ter.
   *
   * @return string
   *   Retorna por valor primeiro pedaço da palavra e o segundo por referência.
   */

  private function breakWord(string $word, string &$word2, int $length): string {
    $auxAr = str_split($word, 1);
    $word = "";
    $i = 0;
    for (; $i < $length; $i++) {
      $word .= $auxAr[$i];
    }
    for (; $i < count($auxAr); $i++) {
      $word2 .= $auxAr;
    }
    return $word;
  }

  /**
   * Quebra uma string em diversas strings com tamanho passado por parâmetro.
   *
   * @param string $text
   *   O texto que será utilizado como entrada.
   * @param int $length
   *   Em quantos caracteres a linha deverá ser quebrada.
   *
   * @return array
   *   Um array de strings equivalente ao texto recebido por parâmetro porém
   *   respeitando o comprimento de linha e as regras especificadas acima.
   */
  public function textWrap(string $text, int $length): array {
    $result = [];
    $word = "";
    $aux = "";
    $aux2 = "";
    $this->myText = $text;
    $this->uSafe = str_split($this->myText, 1);
    $this->len = count($this->uSafe);
    if ($this->len < 1){
      return [""];
    }
    while ($this->index < $this->len) {
      $aux = $this->getWord();
      if ($this->counter - 1 > $length) {
        if (strlen($aux) < $length) {
          array_push($result, $word);
          $word = $aux;
          $this->counter = 0;
          $this->blank = "";
        } 
        else {
          do {
            $aux = $this->breakWord($aux, $aux2, $length);
            $word .= $aux;
            array_push($result, $word);
            $word = "";
            $aux = $aux2;
          } while (strlen($aux2) > $length);
          $aux2 .= $this->blank;
          $this->blank = "";
          $word = $aux2;
          $this->counter = mb_strlen($aux2);
          $aux2 = "";
        }
      } 
      elseif ($this->counter - 1 == $length) {
        $word .= $aux;
        array_push($result, $word);
        $this->counter = 0;
        $word = "";
      } 
      else {
        $aux .= $this->blank;
        $this->blank = "";
        $word .= $aux;
      }
    }
    return $result;
  }

}
