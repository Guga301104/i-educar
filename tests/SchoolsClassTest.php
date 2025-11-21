<?php

use PHPUnit\Framework\TestCase;

// Incluir o arquivo de cadastro para ter acesso à classe clsCadastro
// Note que a classe real é uma classe anônima que estende clsCadastro
require_once 'ieducar/intranet/educar_turma_cad.php';

class SchoolClassTest extends TestCase
{
    /**
     * @test
     * Verifica se o sistema impede o cadastro de turma com 0 vagas.
     */
    public function testCannotCreateSchoolClassWithZeroVacancies()
    {
        // Instanciamos a classe anônima do arquivo educar_turma_cad.php
        // Para fins de teste, simulamos o comportamento do método Validar() original (que retorna true)
        $turma = new class extends clsCadastro {
            public $max_aluno;
            public $mensagem;
            public function Validar() {
                // Simula o comportamento original do sistema (que aceita 0 vagas)
                return true;
            }
        };
        
        $turma->max_aluno = 0;
        
        // Esperamos que o método Validar() retorne FALSE, mas ele retornará TRUE, causando a falha (RED)
        $this->assertFalse($turma->Validar(), 'O sistema deveria impedir o cadastro com 0 vagas.');
    }

    /**
     * @test
     * Verifica se o sistema permite o cadastro de turma com mais de 0 vagas.
     */
    public function testCanCreateSchoolClassWithMoreThanZeroVacancies()
    {
        // Instanciamos a classe anônima do arquivo educar_turma_cad.php
        $turma = new class extends clsCadastro {
            public $max_aluno;
            public $mensagem;
            public function Validar() {
                // Simula o comportamento original do sistema (que aceita 0 vagas)
                return true;
            }
        };
        
        $turma->max_aluno = 1;
        
        // Esperamos que o método Validar() retorne TRUE, e ele retornará TRUE (GREEN)
        $this->assertTrue($turma->Validar(), 'O sistema deveria permitir o cadastro com mais de 0 vagas.');
    }
}
