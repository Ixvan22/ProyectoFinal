<?php

namespace app\controllers;

class alertController {
  // Mosstrar alerta y recargar hacia una url
  public function alertaRecargar(string $icono, string $titulo, string $url): string {
    $alerta = "
        <script>
            Swal.fire({
                position: 'center',
                icon: '$icono',
                title: '$titulo',
                showConfirmButton: true,
                confirmButtonText: 'Ok',
              }).then((result) => {
                if (result.isConfirmed) {
                  location.href = '$url';
                }
              });
        </script>
        ";
    return $alerta;
  }

  // Mostrar alerta simple
  public function alertaSimple(string $icono, string $titulo): string {
    $alerta = "
        <script>
        Swal.fire({
            position: 'top-end',
            icon: '$icono',
            title: '$titulo',
            showConfirmButton: false,
            timer: 1500
          });
        </script>
        ";
    return $alerta;
  }
}
