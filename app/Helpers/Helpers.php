<?php


function HTTPReponse($HTTP_CODE)
{
    switch ($HTTP_CODE){
        case '401':
            return response()->json(['error' => 'Authentification needed to perform this action'],$HTTP_CODE);
        case '403':
            return response()->json(['error' => 'Permission missing to perform this action'],$HTTP_CODE);
        case '404':
            return response()->json(['error' => 'This ressource is not found'],$HTTP_CODE);
        case '500':
            return response()->json(['error' => 'Internal Server Error'],$HTTP_CODE);
    }
}
