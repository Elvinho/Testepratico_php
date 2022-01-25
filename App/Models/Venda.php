<?php
    namespace App\Models;
    use MF\Model\Model;


    class Venda extends Model
    {
        private $codigo_venda;
        private $data;
        private $codigo_cliente;
        private $codigo_produtos;
        private $total;


        public function __get($atributo)
        {
            return $this->$atributo;
        }

        public function __set($atributo, $valor)
        {
            $this->$atributo = $valor;
        }

        //Listar
        public function listarVenda()
        {
            $query = "SELECT * FROM tb_venda";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        
        //salvar
        public function salvarVenda()
        {
            $query = "INSERT INTO tb_venda(data_hora_venda, codigo_cliente,codigo_produtos,total)VALUES(:data_hora_venda, :codigo_cliente,:codigo_produtos,:total)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':data_hora_venda', 'NOW()');
            $stmt->bindValue(':codigo_cliente', $this->__get('codigo_cliente'));
            $stmt->bindValue(':codigo_produtos', $this->__get('codigo_produtos'));
            $stmt->bindValue(':total', $this->__get('total'));

            $stmt->execute();
            
           /*  $insertItem ="INSERT INTO tb_venda_item (codigo_venda,id_produto,quantidade)VALUES(:codigo_venda,:id_produto,:quantidade)";
            $stmt = $this->db->prepare($insertItem);
            $stmt->bindValue(':codigo_venda', $this->db->lastInsertId());
            $stmt->bindValue(':id_produto', $this->__get('id_produto'));
            $stmt->bindValue(':quantidade', $this->__get('quantidade'));
            $stmt->execute(); */
            
            return $this;
        }

        //validar se o cadastro pode ser feito uma descrição minima
       public function validarCadastro()
        {
            $valido = true;
            if(strlen($this->__get('quantidade') < 0))
            {
                $valido = false;
                echo '<script> alert("Informe uma quantidade válida ")</script>';
            }
           
            return $valido;
        }

        //recuperar uma venda por nocliente
        public function getVendaPorCodigoCliente()
        {
            $query = "SELECT * 
                        FROM tb_venda v 
                        LEFT JOIN tb_venda_item tvi ON tvi.codigo_venda = v.codigo_venda
                        WHERE codigo_cliente = :codigo_cliente";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':codigo_cliente', $this->__get('codigo_cliente'));
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

?>