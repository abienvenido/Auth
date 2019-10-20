<?php
class Usuario
{
	private $pdo;
    
    public $id;
    public $Usuario;
    public $Password;
    public $Token;
    public $TokenCaducidad;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Acceder($usuario, $password)
	{
		try 
		{
			$stm = $this->pdo->prepare(
                "SELECT * FROM usuario WHERE usuario = ? AND password = ?"
            );

			$stm->execute([
                $usuario,
                sha1($password)
            ]);
            
			$result = $stm->fetch(PDO::FETCH_OBJ);
            
            if(!is_object($result)) {
                return new Usuario;
            } else {
                return $result;
            }
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}