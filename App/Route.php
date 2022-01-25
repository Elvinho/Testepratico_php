<?php
namespace App;
use MF\Init\Bootstrap;

class Route extends Bootstrap
{
    protected function initRoutes()
    {
        $routes['home'] = array(
            'route'      => '/',
            'controller' => 'indexController',
            'action'     => 'index'
        );

          //clientes
        $routes['inscreverse'] = array(
            'route'      => '/inscreverse',
            'controller' => 'indexController',
            'action'     => 'inscreverse'
        );
      
        $routes['registrar'] = array(
            'route'      => '/registrar',
            'controller' => 'indexController',
            'action'     => 'registrar'
        );

        $routes['listar_clientes'] = array(
            'route'      => '/listar_clientes',
            'controller' => 'indexController',
            'action'     => 'listar'
        );

        //produtos
        $routes['registrar_produtos'] = array(
            'route'      => '/registrar_produtos',
            'controller' => 'indexController',
            'action'     => 'registrarProdutos'
        );
        $routes['cadastrar_prod'] = array(
            'route'      => '/cadastrar_prod',
            'controller' => 'indexController',
            'action'     => 'regProduto'
        );

        $routes['listar_produtos'] = array(
            'route'      => '/listar_produtos',
            'controller' => 'indexController',
            'action'     => 'listarProdutos'
        );

        //vendas
        $routes['registrar_venda'] = array(
            'route'      => '/cadastrar_venda',
            'controller' => 'indexController',
            'action'     => 'venda'
        );
        $routes['cadastrar_venda'] = array(
            'route'      => '/registrar_venda',
            'controller' => 'indexController',
            'action'     => 'registrarVenda'
        );

        $routes['listar_vendas'] = array(
            'route'      => '/listar_vendas',
            'controller' => 'indexController',
            'action'     => 'ListarVendas'
        );


        $this->setRoutes($routes);
    }

   
}
?>