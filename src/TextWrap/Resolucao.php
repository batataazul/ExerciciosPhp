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
  private function isBlank(string $char): bool {
    $pattern = "/\s/u";
    if (mb_strlen($char,"UTF-8") > 1) {
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
    for (; $this->index < $this->len; $this->index++) {
      if ($this->isBlank($this->uSafe[$this->index])) {
        $this->blank = $this->uSafe[$this->index];
        $this->index++;
        $this->counter += mb_strlen($word, "UTF-8");
        $this->counter++;
        return $word;
      }
      else {
        $word .= $this->uSafe[$this->index];
      }
    }
    $this->counter += mb_strlen($word, "UTF-8");
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
  private function breakWord(string $word, int $length): array {
    $auxAr = str_split($word, 1);
    $word = "";
    $word2 = "";
    for ($i = 0; mb_strlen($word,"UTF-8") < $length; $i++) {
      $word .= $auxAr[$i];
    }
    for ($i = $length; $i < count($auxAr); $i++) {
      $word2 .= $auxAr[$i];
    }
    $returnVec = [$word, $word2];
    return $returnVec;
  }

  /**
   * Função que remove espaços em branco do final de cada string de um vetor.
   *
   * @param array $vectorT
   *   Vetor de Strings.
   *
   * @return array
   *   Novo vetor de Strings corrigido, sem espaços em branco no final.
   */
  private function removeBlank(array $vectorT): array {
    for ($i = 0; $i < count($vectorT); $i++) {
      $word = "";
      $array = str_split($vectorT[$i], 1);
      $len = count($array);
      if ($this->isBlank($array[$len - 1])) {
        array_pop($array);
      }
      foreach ($array as $key => $value) {
        $word .= $value;
      }
      $vectorT[$i] = $word;
    }
    return $vectorT;
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
    if (empty($text)) {
      return [""];
    }
    $this->myText = $text;
    $this->uSafe = str_split($this->myText, 1);
    $this->len = count($this->uSafe);
    while ($this->index < $this->len) {
      $counterAux = $this->counter;
      $aux = $this->getWord();
      if ($this->counter - 1 > $length) {
        if (mb_strlen($aux, "UTF-8") <= $length) {
          array_push($result, $word);
          $word = $aux;
          $word .= $this->blank;
          $this->counter = mb_strlen($word, "UTF-8");
          $this->blank = "";
        }
        else {
          do {
            $left = $length - $counterAux;
            $auxVec = $this->breakWord($aux, $left);
            $counterAux = 0;
            $aux = $auxVec[0];
            $aux2 = $auxVec[1];
            $word .= $aux;
            array_push($result, $word);
            $word = "";
            $aux = $aux2;
          } while (mb_strlen($aux2,"UTF-8") > $length);
          $aux2 .= $this->blank;
          $this->blank = "";
          $word = $aux2;
          $this->counter = mb_strlen($aux2, "UTF-8");
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
    if (!empty($word)) {
      array_push($result, $word);
    }
    $result = $this->removeBlank($result);
    return $result;
  }

}
