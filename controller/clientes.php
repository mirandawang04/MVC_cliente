<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("model/clientes.php");

class ClientesControlador
{
    public static function index()
    {
        $clientes = new ClientesModelo();
        $clientes->Seleccionar();
        require_once("view/clientes.php");
    }

    public function Nuevo()
    {
        $opcion = 'NUEVO'; // Opción de insertar un cliente.
        require_once("view/clientesmantenimiento.php");
    }

    public function Insertar()
    {
        $cliente = new ClientesModelo();
        $cliente->nombre = htmlspecialchars($_POST['nombre']); // Evitar inyección HTML
        $cliente->email = htmlspecialchars($_POST['email']);   // Evitar inyección HTML

        if ($cliente->Insertar() == 1) {
            header("location:" . URLSITE);
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    public function Editar()
    {
        $cliente = new ClientesModelo();
        $cliente->id = $_GET['id'];
        $opcion = 'EDITAR'; // Opción de modificar un cliente.

        if ($cliente->Seleccionar()) {
            require_once("view/clientesmantenimiento.php");
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    public function Modificar()
    {
        $cliente = new ClientesModelo();
        $cliente->id = $_GET['id'];
        $cliente->nombre = htmlspecialchars($_POST['nombre']); // Evitar inyección HTML
        $cliente->email = htmlspecialchars($_POST['email']);   // Evitar inyección HTML

        // Aquí hay que tener cuidado, en el caso de que se pulse el botón de aceptar
        // pero no se haya modificado nada, la función modificar devolverá un cero,
        // por eso hay que comprobar que no hay error.
        if (($cliente->Modificar() == 1) || ($cliente->GetError() == '')) {
            header("location:" . URLSITE);
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    public function Borrar()
    {
        $cliente = new ClientesModelo();
        $cliente->id = $_GET['id'];

        if ($cliente->Borrar() == 1) {
            header("location:" . URLSITE);
        } else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
}
