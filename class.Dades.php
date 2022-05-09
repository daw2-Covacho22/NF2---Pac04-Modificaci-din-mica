<?php
require("abstract.databoundobject.php");
class Dades extends DataBoundObject{

        protected $id;
        protected $paraula;
        protected $total;
        protected $ultimavisita;


        protected function DefineTableName() {
                return("datos");
        }

        protected function DefineRelationMap() {
                return(array(
                        "id" => "id",
                        "paraula" => "paraula",
                        "total" => "total",
                        "ultimavisita" => "ultimavisita"));
        }
}


?>