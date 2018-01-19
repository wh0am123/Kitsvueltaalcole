<?php

class bbdd {

  private $conn;
  private $host;
  private $usuario;
  private $pass;
  private $bd;

  public function __construct() {

    $this->host = BASE_HOST;
    $this->usuario = BASE_USER;
    $this->pass = BASE_PASS;
    $this->bd = BASE_BASE;
    
    $this->conn = $this->conectar();
    
  }

  public function conectar() {

    //$conex=mysql_connect($this->host,$this->usuario);SET PASSWORD FOR 'your_user'@'your_host' = PASSWORD ( 'your_old_password');
    $conex = mysqli_connect( $this->host, $this->usuario, $this->pass);
    
    if($conex) {

      if(! mysqli_select_db( $conex,$this->bd)) echo 'no selecciono la bd';
      
    } else
      echo 'no se conecto';
      
    return $conex;
    
  }

  public function bbdd_query( $sql ) {

    $r = mysqli_query( $sql, $this->conn ) or die( mysqli_error($conex));
    
    return $r;
    
  }

  public function bbdd_fetch( $r ) {

    $row = mysqli_fetch_array( $r ,$this->conn);
    
    return $row;
    
  }

  public function bbdd_num( $r ) {

    $cant = mysql_num_rows( $r );
    
    return $cant;
    
  }

  public function bbdd_qnum( $sql ) {

    $r = $this->bbdd_query( $sql );
    
    $cant = mysql_num_rows( $r );
    
    return $cant;
    
  }

  public function bbdd_id() {

    $id = mysqli_insert_id( $this->conn );
    
    return $id;
    
  }

  public function bbdd_desc() {

    mysql_close();
  }

  public function bbdd_seguridad( $valor ) {

    return mysql_real_escape_string( stripslashes( $valor ) );
    
  }

  public function bbdd_afectadas() {

    return mysql_affected_rows( $this->conn );
    
  }

  public function bbdd_dato( $tabla, $campo, $where ) {

    $r = $this->bbdd_query( 'SELECT ' . $campo . ' FROM ' . $tabla . ' ' . $where );
    
    $row = mysql_fetch_array( $r,$this->conn);
    
    return $row[ $campo ];
    
  }

}

$bd = new bbdd();
?>