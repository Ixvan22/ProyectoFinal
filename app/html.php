<?php

namespace moderno;

class Html
{
    private string $doctype;
    private string $head;
    private string $body;

    public function __construct(string $titulo,string $doctype=null)
    {
        $this->doctype = $doctype??$this->doctype();
        $this->completarHEAD($this->codigoTitulo($titulo).
            $this->codigoJuegoCaracteres().
            $this->codigoBootstrapLink());
        $this->completarBODY();
    }

    private function doctype():string{
        $resultado = "<!doctype html>";
        return $resultado;
    }

    public function completarHEAD(string $contenido=""):Html{
        $this->head = "<head>               
                        $contenido
                      </head>";
        return $this;
    }

    public function codigoTitulo(string $titulo):string{
        $resultado = "<title>$titulo</title>";
        return $resultado;
    }

    public function codigoBootstrapLink():string{
        return '<link href="'.APP_URL.'app/content/css/bootstrap.min.css" rel="stylesheet"';
    }

    public function codigoBootstrapScript():string{
        return '<script src="'.APP_URL.'app/content/js/bootstrap.min.js" defer="defer"></script>';
    }

    public function codigoFontAwesome():string {
        return '<script src="https://kit.fontawesome.com/2492101989.js" crossorigin="anonymous"></script>';
    }

    public function codigoModalBootstap(string $titulo, string $texto):string{
        $resultado='<div class="modal" id="modal" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">'.$titulo.'</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p>'.$texto.'</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <script>(new bootstrap.Modal("#modal")).show();</script>';
        return $resultado;
    }

    public function codigoJuegoCaracteres(string $tabla="utf-8"):string{
        $resultado = "<meta charset=\"$tabla\" />";
        return $resultado;
    }

    public function completarBODY(string $contenido=""):Html{
        $this->body = "<body>
                        $contenido
                       </body>";
        return $this;
    }

    public function paginaHTML():string{
        $resultado = $this->doctype."<html>".$this->head.$this->body."</html>";
        return $resultado;
    }

}