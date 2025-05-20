<?php

namespace Microblog\Auth;

//Sobre sessões no PHP sessão (Session) é uma funcionalidade usada para o controle de acesso e outras informações que sejam importantes enquanto o navegador estiver aberto com o site

//Exemplos: Áreas administrativos, painel de controle/dashboard, área do cliente, área do aluno etc.

//Nestas áreas o acesso se dá através de alguma forma de autenticação. Exemplos:
//login/senha, biometria, facial, 2-fatores etc.

final class ControleDeAcesso
{

  private function __construct() {}


  //Inicia uma sessão caso não tenha nenhuma em andamento
  private static function iniciarSessao(): void
  {
    if (!isset($_SESSION)) session_start();
  }


  //"Bloqueia" páginas admin caso o usuário NÂO ESTEJA logado
  public static function exigirLogin(): void

  {  //Inicia sessão (se necessário)
    self::iniciarSessao();

    //Se NÃO EXISTIR uma variavel de sessão chamada ID
    if (!isset($_SESSION['id'])) {
      session_destroy();
      header("location:../login.php?acesso_proibido");
      exit;
    }
  }

  public static function login(int $id, string $nome, string $tipo): void
  {
    self::iniciarSessao();

    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $_SESSION['tipo'] = $tipo;

  }
  
  public static function logout():void
  {
    self::iniciarSessao();
    session_destroy();
    header("location:../login.php?logout");
    exit;

  }

   public static function exigirAdmin():void
   {
      self::iniciarSessao();
      if($_SESSION['tipo'] !== 'admin'){
        header("location:nao-autorizado.php");
        exit;

      }

   }


}
