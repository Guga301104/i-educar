// Arquivo: tests/Unit/LegacyDisciplineScoreTest.php

<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\LegacyDisciplineScore;

// Simulação da classe Util para que o teste possa ser executado
class Util {
    public static function format($score, $decimalPlaces) {
        return is_numeric($score) ? number_format($score, $decimalPlaces, '.', '') : $score;
    }
}

class LegacyDisciplineScoreTest extends TestCase
{
    // Método auxiliar para criar um mock do modelo
    private function createScoreMock($nota, $notaArredondada = null)
    {
        // ... (código de mock omitido por brevidade)
        $mock = new LegacyDisciplineScore(); // Simulação simplificada
        $mock->nota = $nota;
        $mock->nota_arredondada = $notaArredondada ?? $nota;
        return $mock;
    }

    /**
     * CT1: Testa o cenário Falso/Falso (F, F) da Decisão D2.
     * Deve retornar a nota formatada.
     */
    public function testScoreValidNote_MC_DC_F_F()
    {
        $scoreModel = $this->createScoreMock(7.5);
        $expected = '7.5';
        $this->assertEquals($expected, $scoreModel->score(1, false, false));
    }

    /**
     * CT2: Testa o cenário Verdadeiro/Falso (V, F) da Decisão D2.
     * Cobre a independência da Condição C1. Deve retornar o valor não numérico.
     */
    public function testScoreNonNumericNote_MC_DC_V_F()
    {
        $scoreModel = $this->createScoreMock('Faltou');
        $expected = 'Faltou';
        $this->assertEquals($expected, $scoreModel->score(1, false, false));
    }

    /**
     * CT3: Testa o cenário Falso/Verdadeiro (F, V) da Decisão D2.
     * Cobre a independência da Condição C2. Deve retornar a nota formatada (0.0).
     */
    public function testScoreZeroNote_MC_DC_F_V()
    {
        $scoreModel = $this->createScoreMock(0);
        $expected = '0.0';
        $this->assertEquals($expected, $scoreModel->score(1, false, false));
    }

    /**
     * CT4: Testa o cenário Verdadeiro/Verdadeiro (V, V) da Decisão D2.
     * Caso adicional de nota nula.
     */
    public function testScoreNullNote_MC_DC_V_V()
    {
        $scoreModel = $this->createScoreMock(null);
        $expected = null;
        $this->assertEquals($expected, $scoreModel->score(1, false, false));
    }
}
