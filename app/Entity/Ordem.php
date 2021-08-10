<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Ordem{
    /**
     * Identificador único da ordem de serviço
     * @var integer
     */
    public $id;

    /**
     * Título da ordem de serviço
     * @var string
     */
    public $titulo;

    
    /**
     * Descrição da ordem de serviço (pode conter html)
     * @var string
     */
    public $descricao;

    
    /**
     * Define se a ordem de serviço está ativa
     * @var string(s/n)
     */
    public $ativo;


    /**
     * Data de publicação da ordem de serviço
     * @var string
     */
    public $data;

    /**
     * Método responsável por cadastrar uma nova ordem de serviço
     * @return bollean
     */
    public function cadastrar(){
        //DEFINIR A DATA
        $this->data = date('Y-m-d H:i:s');

        //INSERIR A ORDEM NO BANCO
        $obDatabase = new Database('ordens');
        $this->id = $obDatabase->insert([
                                            'titulo'    => $this->titulo,
                                            'descricao' => $this->descricao,
                                            'ativo'     => $this->ativo,
                                            'data'      => $this->data,
                                        ]);
        //RETORNAR SUCESSO
        return true;
    }

    /**
     * Método responsável por atualizar a ordem de serviço no banco
     * @return boolean
     */
    public function atualizar(){
        return (new Database('ordens'))->update('id = '.$this->id,[
                                                                    'titulo'    => $this->titulo,
                                                                    'descricao' => $this->descricao,
                                                                    'ativo'     => $this->ativo,
                                                                    'data'      => $this->data,
                                                                ]);

        //RETORNAR SUCESSO
        return true;
    }

    /**
     * Método responsável por excluir a ordem de serviço no banco
     * @return boolean
     */
    public function excluir(){
        return (new Database('ordens'))->delete('id = '.$this->id);

        //RETORNAR SUCESSO
        return true;
    }

    /**
     * Método responsável por obter as ordens de serviço do banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getOrdens($where = null, $order = null, $limit = null){
        return (new Database('ordens'))->select($where,$order,$limit)
                                      ->fetchAll(PDO::FETCH_CLASS,self::class);
    }
    
    /**
     * Método responsável por obter a quantidade de ordens de serviço do banco de dados
     * @param string $where
     * @return array
     */
    public static function getQuantidadeOrdens($where = null){
        return (new Database('ordens'))->select($where,null,null,'COUNT(*) as qtd')
                                      ->fetchObject()
                                      ->qtd;
    }
    
    /**
     * Método responsável por buscar uma ordem de serviço com base no seu ID
     * @param integer $id
     * @return Ordem
     */
    public static function getOrdem($id){
        return (new Database('ordens')) ->select('id = '.$id)
                                       ->fetchObject(self::class);
    }
}  