<?php
    namespace App\Models;
    use MF\Model\Model;


    class Cliente extends Model
    {
        private $id;
        private $nome;
        private $email;
        private $cpf;
        private $endereco;
        private $data_nascimento;


        public function __get($atributo)
        {
            return $this->$atributo;
        }

        public function __set($atributo, $valor)
        {
            $this->$atributo = $valor;
        }

    //Listar
        public function listar()
        {
            $query = "SELECT * FROM clientes";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        
    //salvar
        public function salvar()
        {
            $query = "INSERT INTO clientes(nome, cpf, endereco, email, data_nascimento)VALUES(:nome, :cpf, :endereco, :email, :data_nascimento)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':cpf', $this->__get('cpf'));
            $stmt->bindValue(':endereco', $this->__get('endereco'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':data_nascimento', $this->__get('data_nascimento'));
            $stmt->execute();

            return $this;
        }

    //validar se o cadastro pode ser feito
        public function validarCadastro()
        {
            $valido = true;
            if(strlen($this->__get('nome') < 3))
            {
                $valido = false;
            }
           
            return $valido;
        }

            //recuperar um usuario por cpf
            public function getClientePorCpf()
            {
                $query = "SELECT nome,cpf FROM clientes WHERE cpf = :cpf";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':cpf', $this->__get('cpf'));
                $stmt->execute();

                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
    }

?>