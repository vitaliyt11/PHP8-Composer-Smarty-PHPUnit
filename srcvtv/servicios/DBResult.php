<?php
namespace DWES04SOL\servicios;

enum DBResult: int {
    case VTV_DB_EXCEPTION = -1;
    case VTV_DB_OPNOTFULFILLED = -2;
    case VTV_DB_NOCOLS_AFFECTED = -3; //OPCIONAL
    case VTV_DB_EMPTYRESULT = -4;
}

?>