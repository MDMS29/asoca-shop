<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ProductosModel;
use App\Models\ImgProductoModel;
use App\Models\ValoracionModel;
use App\Models\ParamDetModel;

class Productos extends BaseController
{
    protected $producto, $imgProducto, $valoracion, $param;
    public function __construct()
    {
        $this->producto = new ProductosModel();
        $this->imgProducto = new ImgProductoModel();
        $this->valoracion = new ValoracionModel();
        $this->param = new ParamDetModel();
    }
    public function obtenerProductos()
    {
        $estado = $this->request->getPost('estado');
        $res = $this->producto->obtenerProductos($estado, 0);
        return json_encode($res);
    }
    public function adminProductos()
    {
        $categoria = $this->param->obtenerCategoriaProd('A');
        $data = ['categorias' => $categoria];
        echo view('components/navbar');
        echo view('productos/admin/adminProductos', $data);
    }
    public function buscarProducto()
    {
        $id = $this->request->getPost('id');
        $nombre = $this->request->getPost('nombre');
        $res = $this->producto->buscarProducto($id, $nombre, session('id'));
        return json_encode($res);
    }
    public function insertar()
    {
        $id = $this->request->getPost('id');
        $tp = $this->request->getPost('tp');
        $nombre = $this->request->getPost('nombre');
        $categoria = $this->request->getPost('categoria');
        $descripcion = $this->request->getPost('descripcion');
        $precio = $this->request->getPost('precio');
        $cantidad = $this->request->getPost('cantidad');
        $fecha = $this->request->getPost('fecha');
        $foto = $this->request->getFile('foto');
        $foto1 = $this->request->getFile('foto1');
        $foto2 = $this->request->getFile('foto2');

        $fotos = ['foto' => $foto, 'foto1' => $foto1, 'foto2' => $foto2];

        
        $dataProducto = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'categoria' => $categoria,
            'cantidad_actual' =>  $cantidad,
            'precio' =>  $precio,
            'fecha_public' =>  $fecha == '' ? date('Y-m-d') : $fecha,
            'usuario_crea' => session('id')
        ];
        if ($tp == 2) {
            if ($this->producto->update($id, $dataProducto)) {
                return json_encode(1);
            } else {
                return json_encode(2);
            }
        } else {
            if ($this->producto->save($dataProducto)) {
                $item = 0;
                foreach ($fotos as $foto) {
                    $item = $item + 1;
                    if ($foto->isValid() && !$foto->hasMoved()) {
                        $newName = $id . $foto->getName(); //Nombre de imagen
                        $uploadPath = 'fotoProductos';
                        if (!is_dir($uploadPath)) { // Verificar si el directorio existe, si no, crearlo
                            mkdir($uploadPath, 0777, true);
                        }
                        $foto->store($uploadPath, $newName); // Guardar el archivo en el directorio
                        $rutaImagen = $foto->getName(); // Obtener la ruta de la imagen guardada
                    } else if ($foto == null && $tp == 1) {
                        $rutaImagen = 'null';
                        // } else if ($foto == null && $tp == 2) {
                        //     $rutaImagen = $res['foto'];
                    }
                    $this->imgProducto->save([
                        'item' => $item,
                        'nombre_img' => $rutaImagen,
                        'id_producto' => $this->producto->getInsertID(),
                        'usuario_crea' => session('id')
                    ]);
                }
                return json_encode(1);
            } else {
                return json_encode(2);
            }
        }
    }
    public function cambiarEstado()
    {
        $id = $this->request->getPost('id');
        $estado = $this->request->getPost('estado');
        if ($this->producto->update($id, ['estado' => $estado])) {
            if ($estado == 'A') {
                return '¡Se ha reestablecido el Producto!';
            } else {
                return '¡Se ha eliminado el Producto!';
            }
        } else {
            return 2;
        }
    }
    public function adminProductosEliminados()
    {
        echo view('components/navbar');
        echo view('productos/admin/adminProductosEliminados');
    }
    public function verDetallesProducto($id)
    {
        $res = $this->producto->buscarProducto($id, '', 0);
        $data = ['producto' => $res];
        echo view('components/navbar');
        echo view('productos/detallesProducto', $data);
    }
    public function urlImg()
    {
        $id = $this->request->getPost('id');
        $res = $this->imgProducto->obtenerImagenes($id);
        return json_encode($res);
    }
    public function imagenesProducto($name)
    {
        // $id = $this->request->getPost('id');
        // $res = $this->imgProducto->obtenerImagenes($id);
        // return json_encode($res);
        // if ($res['nombre_img'] == '') {
        //     $rutaImagen = '/uploads/fotoUser/default.png';
        //     $rutaCompleta = WRITEPATH . $rutaImagen;
        // } else {
        $rutaImagen = '/uploads/fotoProductos/' . $name;
        $rutaCompleta = WRITEPATH . $rutaImagen;
        // }

        $fp = fopen($rutaCompleta, 'rb');

        header("Content-Type: image/png");
        header("Content-Length: " . filesize($rutaCompleta));
        fpassthru($fp);
    }
    public function productosCategoria(){
        $id = $this->request->getPost('id');
        $categoria = $this->request->getPost('categoria');
        $estado = $this->request->getPost('estado');
        $res = $this->producto->productosCategoria($id, intval($categoria), $estado);
        if(empty($res)){
            $res = $this->producto->obtenerProductos($estado, $id);
        }
        return json_encode($res);
    }
}