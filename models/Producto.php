<?php
    class Producto extends Conectar {

        public function insert_producto($prod_nombre,$prod_cantidad,$prod_precio){

            $conectar = parent::conexion();
            parent::set_names();
            $sql="INSERT INTO productos (prod_id, prod_nombre, prod_cantidad, prod_precio, est) VALUES (NULL, ?, ?, ?, '1');";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1,$prod_nombre);
            $stmt->bindValue(2,$prod_cantidad);
            $stmt->bindValue(3,$prod_precio);

            $stmt->execute();
        }
    }
?>