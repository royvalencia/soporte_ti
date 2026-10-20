<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
require_once(ROOT . DS . 'vendor' . DS . 'fpdf' . DS . 'fpdf.php'); // Ruta a FPDF

class PdfComponent extends Component
{
    public function createPdf($title, $data = [], $outputFile = 'I', $images = [], $customFont = null)
    {
        try {
            // Crear una nueva instancia de FPDF
            $pdf = new \FPDF();
            $pdf->AddPage();

            // Configurar título
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, $title, 0, 1, 'C');

            // Configurar fuente personalizada (si se proporciona)
            if ($customFont) {
                $pdf->AddFont($customFont, '', $customFont . '.php');
                $pdf->SetFont($customFont, '', 12);
            } else {
                $pdf->SetFont('Arial', '', 12);
            }

            // Agregar contenido
            foreach ($data as $line) {
                $pdf->Cell(0, 10, $line, 0, 1);
            }

            // Agregar imágenes (si se proporcionan)
            foreach ($images as $image) {
                if (file_exists($image['path'])) {
                    $pdf->Image($image['path'], $image['x'], $image['y'], $image['width'], $image['height']);
                } else {
                    throw new \InvalidArgumentException('La imagen no existe: ' . $image['path']);
                }
            }

            // Salida del PDF
            $pdf->Output($outputFile); // 'I' para mostrar en el navegador, 'D' para descargar
            
        } catch (\Exception $e) {
            throw new \RuntimeException('Error al generar el PDF: ' . $e->getMessage());
        }
    }
}