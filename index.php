<?php
include_once 'controlador/C_inicio.php';
include_once 'controlador/C_crearp.php';
include_once 'controlador/C_unirp.php';
include_once 'controlador/C_consulta.php';

include_once 'modelo/consultat.php';

$Ver = new C_inicio;
error_reporting(0);

$Crear = new CrearP;
$Busca = new UnirP;
$Consulta = new C_consultar;


if (isset($_GET['nom_jug'])) {
    $Ver->Ver("vista/crear.php");
} else {
    if (isset($_GET['nombre_jug'])) {
        $nom = $_GET['nombre_jug'];
        $Crear->CrearTP($nom);
        $Ver->Ver("vista/Jugador1.php");
    } else {
        if (isset($_GET['cod_partida'])) {
            $codigo = $_GET['cod_partida'];
            $respuesta =  $Busca->BuscarP($codigo);

            if ($respuesta == TRUE) {
                $respuesta = $Consulta->Cconsulta($codigo);

                if ($respuesta >= 4) {
                    echo "Partida llena";
                    $Ver->Ver("vista/crear.php");
                } else {
                    if ($respuesta == 1) {
                        $nom = $_GET['nombre_jugador'];
                        $Ver->Ver("vista/Jugador2.php");
                        $Crear->InsertarTP($nom, $codigo);
                    } else {
                        if ($respuesta == 2) {
                            $nom = $_GET['nombre_jugador'];
                            $Ver->Ver("vista/Jugador3.php");
                            $Crear->InsertarTP($nom, $codigo);
                        } else {
                            $nom = $_GET['nombre_jugador'];
                            $Ver->Ver("vista/Jugador4.php");
                            $Crear->InsertarTP($nom, $codigo);
                        }
                    }
                }

            } else {
                echo "No existe una partida relacionada a este código";
                $Ver->Ver("vista/crear.php");
            }
        } else {
            $Ver->Ver("vista/inicio.php");
        }
    }
}
