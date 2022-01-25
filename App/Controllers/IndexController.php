<?php

namespace App\Controllers;

//recursos de miniframework
use MF\Controller\Action;
use MF\Model\Container;

    class IndexController extends Action
    {
        public function index()
        {   
            $this->render('index');
        }

        //caso não existir cadastro para não gerar erros
        public function inscreverse()
        {
            $this->view->cliente = array(
                'nome'            => '',
                'cpf'             => '',
                'email'           => '',
                'endereco'        => '',
                'data_nascimento' => '',
            );
            $this->view->erroCadastro = false;
            $this->render('inscreverse');
        }

        //registrar clientes
        public function registrar()
        {
           
            //receber dados do formulário
           $data = implode("-",array_reverse(explode("/",$_POST["data_nascimento"])));
            $cliente = Container::getModel('Cliente') ;

            $cliente->__set('nome', trim($_POST["nome"]));
            $cliente->__set('cpf', $_POST["cpf"]);
            $cliente->__set('email', $_POST["email"]);
            $cliente->__set('endereco', $_POST["endereco"]);
            $cliente->__set('data_nascimento', $data);

           if($cliente->validarCadastro() && (int)count($cliente->getClientePorCpf()) == 0)
           {    
                $cliente->salvar();
                $this->render('cadastro');
                
           }
           else
           {
               $this->view->cliente = array(
                   'nome' => $_POST["nome"],
                   'cpf' => $_POST["cpf"],
                   'email' => $_POST["email"],
                   'endereco' => $_POST["endereco"],
                   'data_nascimento' => $_POST["data_nascimento"],
               );
               $this->view->erroCadastro = true;
                $this->render('inscreverse');
           }
          
        }
        // listar clientes
        public function listar() 
        {
           $cliente = Container::getModel('Cliente');
           $clientes = $cliente->listar();

           $this->view->clientes = $clientes;
            $this->render('listar_clientes');
        }

        //para não gerar erros em tela
        public function regProduto() 
        {
            $this->view->produto = array(
                'descricao' => '',
                'preco'     => '',
            );

            $this->view->erroCadastro = false;
            $this->render('registrar_produtos');
        }

        public function registrarProdutos()
        {
            $produto = Container::getModel('Produto') ;

            //receber dados do formulário
            $produto->__set('descricao', trim($_POST["descricao"]));
            $produto->__set('preco', $_POST["valor"]);

           if($produto->validarCadastro() && (int)count($produto->getProdutoporNome()) == 0)
           {    
                $produto->salvarProduto();
                $this->render('cadastro');
           }
           else
           {
               
               $this->view->produto = array(
                   'descricao' => $_POST["descricao"],
                   'preco' => $_POST["valor"],
               );

               $this->view->erroCadastro = true;
               $this->render('registrar_produtos');
           }
          
        }

        public function listarProdutos()
        {
            $produto = Container::getModel('Produto');
            $produtos = $produto->listarProduto();

            $this->view->produtos = $produtos;
            $this->render('listar_produtos');
        }

        public function venda()
        {
            $venda = Container::getModel('Venda') ;
            $this->view->venda = array(
                'codigo_produto'  => ' ',
                'data_venda'      => ' ',
                'codigo_cliente'  => ' ',
                'quantidade'      => ' ',
            );

            $this->view->erroCadastro = false;
            $this->render('registrar_venda');
        }

        public function registrarVenda()
        {

            $venda = Container::getModel('Venda') ;
            
            //receber dados do formulário
            $venda->__set('codigo_produtos', $_POST["codigo_produto"]);
            $venda->__set('quantidade', $_POST["quantidade"]);
            $venda->__set('codigo_cliente', $_POST["codigo_cliente"]);
            $venda->__set('data_hora_venda', 'NOW()');
            
            if($venda->validarCadastro())
            {
                $venda->salvarVenda();
                $this->render('cadastro');
            }
            else
            {
                $this->view->venda = array(
                    'codigo_produto'  => $_POST["codigo_produto"],
                    'data_venda'      => $_POST["data_venda"],
                    'codigo_cliente'  => $_POST["codigo_cliente"],
                    'quantidade'      => $_POST["quantidade"],
                );
                $this->view->erroCadastro = true;
                $this->render('registrar_venda');
            }
        }
    }
?>