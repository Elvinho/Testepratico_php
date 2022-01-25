<?php
    namespace App\Models;
    use MF\Model\Model;


    class Produto extends Model
    {
        private $id;
        private $descricao;
        private $preco;


        public function __get($atributo)
        {
            return $this->$atributo;
        }

        public function __set($atributo, $valor)
        {
            $this->$atributo = $valor;
        }

        //Listar
        public function listarProduto()
        {
            $query = "SELECT * FROM tb_produtos";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        
        //salvar
        public function salvarProduto()
        {
            $query = "INSERT INTO tb_produtos(descricao, preco)VALUES(:descricao, :preco)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':descricao', $this->__get('descricao'));
            $stmt->bindValue(':preco', $this->__get('preco'));
            $stmt->execute();

            return $this;
        }

        //validar se o cadastro pode ser feito uma descrição minima
        public function validarCadastro()
        {
            $valido = true;
            if(strlen($this->__get('descricao') < 3))
            {
                $valido = false;
            }
           
            return $valido;
        }

            //recuperar um produto por nome
            public function getProdutoporNome()
            {
                $query = "SELECT descricao,preco FROM tb_produtos WHERE descricao = :descricao";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':descricao', $this->__get('descricao'));
                $stmt->execute();

                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
    }

?>